<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use const http\Client\Curl\AUTH_NTLM;

class StaffController extends Controller
{
    public function index()
    {
        $branch = DB::table('branch')
            ->select('branch_id', 'branch_restaurant','branch_name')
            ->where('branch_restaurant','=',Auth::user()->admin_restaurant)
            ->get();
        return view('staff/staff_list',['branch'=>$branch]);
//        return response($item_category);
    }
    public function staffDetail()
    {
        $result = DB::table('staff')
            ->join('branch','branch.branch_id','=','staff.staff_branch')
            ->select('staff.*','branch.branch_name')
            ->where('staff.staff_restaurant', '=', Auth::user()->admin_restaurant)
            ->get();
        return response($result);
    }


    public function store(Request $request)
    {
        $staff_name = request('staff_name');
        $staff_email = request('staff_email');
        $staff_password = request('staff_password');
        $staff_contact = request('staff_contact');
        $staff_branch = request('staff_branch');
        $counter = request('access_counter');
        $admin = request('access_admin');
        $check_email = DB::table('staff')
            ->select('staff_email')
            ->where('staff_email', '=', $staff_email)
            ->first();
        $staff_id= $staff_name.now();
        if ($check_email == False) {
                    if($counter == 'counter'){
                        $result = DB::table('staff')
                            ->insert([
                                'staff_id' => $staff_id,
                                'staff_name' => $staff_name,
                                'staff_restaurant' => Auth::user()->admin_restaurant,
                                'staff_password' => Hash::make($staff_password),
                                'staff_contact' => $staff_contact,
                                'staff_email' => $staff_email,
                                'staff_branch' => $staff_branch,
                                'counter' => 'yes',
                                'admin' => 'no',
                                'super_admin' => 'no',
                                'staff_active'=> 'yes',
                                'owner' => Auth::user()->email,
                                'created_at'=>now(),
                                'updated_at'=>now()
                            ]);
                        return redirect('staff/staff_list');
                    }else if ($admin == 'admin'){
                        $result = DB::table('staff')
                            ->insert([
                                'staff_id' => $staff_id,
                                'staff_name' => $staff_name,
                                'staff_restaurant' => Auth::user()->admin_restaurant,
                                'staff_password' => Hash::make($staff_password),
                                'staff_contact' => $staff_contact,
                                'staff_email' => $staff_email,
                                'staff_branch' => $staff_branch,
                                'counter' => 'no',
                                'admin' => 'yes',
                                'super_admin' => 'no',
                                'staff_active'=> 'yes',
                                'owner' => Auth::user()->email,
                                'created_at'=>now(),
                                'updated_at'=>now()
                            ]);
                        return redirect('staff/staff_list');
                    }else if ($counter == 'counter' && $admin == 'admin'){
                        $result = DB::table('staff')
                            ->insert([
                                'staff_id' => $staff_id,
                                'staff_name' => $staff_name,
                                'staff_restaurant' => Auth::user()->admin_restaurant,
                                'staff_password' => Hash::make($staff_password),
                                'staff_contact' => $staff_contact,
                                'staff_email' => $staff_email,
                                'staff_branch' => $staff_branch,
                                'counter' => 'yes',
                                'admin' => 'yes',
                                'super_admin' => 'no',
                                'staff_active'=> 'yes',
                                'owner' => Auth::user()->email,
                                'created_at'=>now(),
                                'updated_at'=>now()
                            ]);
                    }




        } else {
            return redirect('staff/staff_list');
        }
    }

    public function active(Request $request)
    {
        $item_code = request('item_code');
        $item_active = DB::table('item')
            ->select('item_active')
            ->where('item_id', '=', $item_code)
            ->first();
        if ($item_active->item_active == 'no') {
            DB::table('item')
                ->where('item_id', '=', $item_code)
                ->update(['item_active' => 'yes']);
        } else {
            DB::table('item')
                ->where('item_id', '=', $item_code)
                ->update(['item_active' => 'no']);
        }

        return redirect('/item/item_master');
    }

    public function update(Request $request)
    {
        $item_code = request('edit_item_code');
        $item_name = request('edit_item_name');
        $item_description = request('edit_item_description');
        $item_price = request('edit_item_price');
        $item_category = request('edit_item_category');
        $item_img = request('edit_item_img');
        if ($request->hasFile('edit_item_img')) {
            if ($request->file('edit_item_img')->isValid()) {
                $profileImage = $request->file('edit_item_img');
                $profileImageSaveAsName = time() . Auth::id() . "-item." . $profileImage->getClientOriginalExtension();

                $upload_path = 'image/item/';
                $item_image_url = $upload_path . $profileImageSaveAsName;
                $success = $profileImage->move($upload_path, $profileImageSaveAsName);

                $result = DB::table('item')
                    ->where('item_id','=',$item_code)
                    ->where('create_by','=',Auth::user()->admin_restaurant)
                    ->update([
                        'item_id' => $item_code,
                        'item_code' => $item_code,
                        'item_name' => $item_name,
                        'item_description' => $item_description,
                        'item_price' => $item_price,
                        'item_category' => $item_category,
                        'item_img' => $item_image_url,
                        'updated_at'=>now()
                    ]);
                return redirect('item/item_master');
            } else {
                return redirect('item/item_master');
            }
        } else {
            $result = DB::table('item')
                ->where('item_id','=',$item_code)
                ->where('create_by','=',Auth::user()->admin_restaurant)
                ->update([
                    'item_id' => $item_code,
                    'item_code' => $item_code,
                    'item_name' => $item_name,
                    'item_description' => $item_description,
                    'item_price' => $item_price,
                    'item_category' => $item_category,
                    'updated_at'=>now()
                ]);
            return redirect('item/item_master');
        }


    }

    public function destroy(Request $request)
    {
        $item_code = request('item_code');


        DB::table('item')
            ->where('item_id', '=', $item_code)
            ->delete();
        return redirect('/item/item_master');



    }
}
