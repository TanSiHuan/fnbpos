<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index()
    {
        $item_category = DB::table('itemcategory')
            ->select('itemCtg_id', 'itemCtg_description')
            ->get();
        return view('item/item_master',['item_category'=>$item_category]);
//        return response($item_category);
    }
    public function itemList()
    {
        $result = DB::table('item')
            ->join('itemcategory','itemcategory.itemCtg_id','=','item.item_category')
            ->select('item.*','itemcategory.itemCtg_description')
            ->where('item.create_by', '=', Auth::user()->admin_restaurant)
            ->get();
        return response($result);
    }


    public function store(Request $request)
    {
        $item_code = request('item_code');
        $item_name = request('item_name');
        $item_description = request('item_description');
        $item_ref_price = request('item_price');
        $item_category = request('item_category');
        $item_img = request('item_name');
        $check_code = DB::table('item')
            ->select('item_code')
            ->where('item_code', '=', $item_code)
            ->first();
        if ($check_code == False) {
            if ($request->hasFile('item_img')) {
                if ($request->file('item_img')->isValid()) {
                    $profileImage = $request->file('item_img');
                    $profileImageSaveAsName = time() . Auth::id() . "-item." . $profileImage->getClientOriginalExtension();

                    $upload_path = 'image/item/';
                    $item_image_url = $upload_path . $profileImageSaveAsName;
                    $success = $profileImage->move($upload_path, $profileImageSaveAsName);

                    $result = DB::table('item')
                        ->insert([
                            'item_code' => $item_code,
                            'item_description' => $item_description,
                            'item_ref_price' => $item_ref_price,
                            'item_category' => $item_category,
                            'item_type'=>'service',
                            'item_img' => $item_image_url,
                            'item_active' => 'yes',
                            'create_by' => Auth::user()->admin_restaurant,
                            'created_at'=>now(),
                            'updated_at'=>now()
                        ]);
                    return redirect('item/item_master');
                } else {
                    return redirect('item/item_master');
                }
            } else {
                return redirect('item/item_master');
            }

        } else {
            return redirect('item/item_master');
        }
    }

    public function active(Request $request)
    {
        $item_code = request('item_code');
        $item_active = DB::table('item')
            ->select('item_active')
            ->where('item_code', '=', $item_code)
            ->first();
        if ($item_active->item_active == 'no') {
            DB::table('item')
                ->where('item_code', '=', $item_code)
                ->update(['item_active' => 'yes']);
        } else {
            DB::table('item')
                ->where('item_code', '=', $item_code)
                ->update(['item_active' => 'no']);
        }

        return redirect('/item/item_master');
    }

    public function update(Request $request)
    {
        $item_code = request('edit_item_code');
        $item_name = request('edit_item_name');
        $item_description = request('edit_item_description');
        $item_ref_price = request('edit_item_price');
        $item_category = request('edit_item_category');
        $item_img = request('edit_item_img');
            if ($request->hasFile('edit_item_img')) {
                if ($request->file('edit_item_img')->isValid()) {
                    $profileImage = $request->file('edit_item_img');
                    $profileImageSaveAsName = time() . Auth::id() . "-item." . $profileImage->getClientOriginalExtension();

                    $upload_path = 'image/item/';
                    $item_image_url = $upload_path . $profileImageSaveAsName;
                    $success = $profileImage->move($upload_path, $profileImageSaveAsName);
                    if($item_category = ''){
                        $result = DB::table('item')
                            ->where('item_code','=',$item_code)
                            ->where('create_by','=',Auth::user()->admin_restaurant)
                            ->update([
                                'item_code' => $item_code,
                                'item_description' => $item_description,
                                'item_ref_price' => $item_ref_price,
                                'item_img' => $item_image_url,
                                'updated_at'=>now()
                            ]);
                    }else{
                        $result = DB::table('item')
                            ->where('item_code','=',$item_code)
                            ->where('create_by','=',Auth::user()->admin_restaurant)
                            ->update([
                                'item_code' => $item_code,
                                'item_description' => $item_description,
                                'item_ref_price' => $item_ref_price,
                                'item_category' => $item_category,
                                'item_img' => $item_image_url,
                                'updated_at'=>now()
                            ]);
                    }
                    return redirect('item/item_master');
                } else {
                    return redirect('item/item_master');
                }
            } else {
                $result = DB::table('item')
                    ->where('item_code','=',$item_code)
                    ->where('create_by','=',Auth::user()->admin_restaurant)
                    ->update([
                        'item_code' => $item_code,
                        'item_description' => $item_description,
                        'item_ref_price' => $item_ref_price,
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
                ->where('item_code', '=', $item_code)
                ->delete();
            return redirect('/item/item_master');



    }
}
