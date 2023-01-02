<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    public function index()
    {
        return view('branch/branch',['message'=>'no']);
    }
    public function BranchList()
    {
        $result = DB::table('branch')
            ->join('admin','admin.id','=','branch.branch_updateBy')
            ->select('admin.admin_name','branch.*')
            ->where('branch.branch_restaurant', '=', Auth::user()->admin_restaurant)
            ->get();
        return response($result);
    }


    public function store(Request $request)
    {
        $branch_name = request('branch_name');
        $branch_contact = request('branch_contact');
        $branch_address = request('branch_address');
        $branch_table_amount = request('branch_table_amount');
        $check_branch_id = DB::table('branch')
            ->select('branch_id')
            ->where('branch_id', '=', $branch_contact)
            ->first();
        if ($check_branch_id == False) {
            $result = DB::table('branch')
                ->insert([
                    'branch_id' => $branch_contact,
                    'branch_name' => $branch_name,
                    'branch_contact' => $branch_contact,
                    'branch_address' => $branch_address,
                    'branch_table_amount' => $branch_table_amount,
                    'branch_currency' => 'RM',
                    'branch_restaurant' => Auth::user()->admin_restaurant,
                    'branch_active' => 'yes',
                    'current_cash' => 0,
                    'branch_updateBy'=>Auth::user()->id,
                    'created_at'=>now(),
                    'updated_at'=>now()
                ]);
            return redirect('/branch/branch_list');

        } else {
            return redirect('/branch/branch_list');
        }
    }

    public function active(Request $request)
    {
        $branch_id = request('branch_id');
        $branch_active = DB::table('branch')
            ->select('branch_active')
            ->where('branch_id', '=', $branch_id)
            ->first();
        if ($branch_active->branch_active == 'no') {
            DB::table('branch')
                ->where('branch_id', '=', $branch_id)
                ->update(['branch_active' => 'yes']);
        } else {
            DB::table('branch')
                ->where('branch_id', '=', $branch_id)
                ->update(['branch_active' => 'no']);
        }

        return redirect('/branch/branch_list');
    }

    public function update(Request $request)
    {
        $branch_name = request('edit_branch_name');
        $branch_contact = request('edit_branch_contact');
        $branch_address = request('edit_branch_address');
        $branch_table_amount = request('edit_branch_table_amount');


            $result = DB::table('branch')
                ->where('branch_id','=',$branch_contact)
                ->update([
                    'branch_id' => $branch_contact,
                    'branch_name' => $branch_name,
                    'branch_contact' => $branch_contact,
                    'branch_address' => $branch_address,
                    'branch_table_amount' => $branch_table_amount,
                    'current_cash' => 0,
                    'branch_updateBy'=>Auth::user()->id,
                    'updated_at'=>now()
                ]);
            return redirect('/branch/branch_list');


    }

    public function destroy(Request $request)
    {
        $branch_id = request('branch_id');
            DB::table('branch')
                ->where('branch_id', '=', $branch_id)
                ->delete();
            return redirect('/branch/branch_list');



    }
}
