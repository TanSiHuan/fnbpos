<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemCategoryController extends Controller
{
    public function index()
    {
        return view('item/item_category',['message'=>'no']);
    }
    public function itemCategoryList()
    {
        $result = DB::table('itemcategory')
            ->select('itemCtg_id', 'itemCtg_description', 'itemCtg_active', 'created_at', 'updated_at')
            ->where('itemCtg_createBy', '=', Auth::user()->admin_restaurant)
            ->get();
        return response($result);
    }


    public function store(Request $request)
    {
        $itmCtg_id = request('itmCtg_id');
        $itmCtg_description = request('itmCtg_description');
        $check_id = DB::table('itemcategory')
            ->select('itemCtg_id')
            ->where('itemCtg_id', '=', $itmCtg_id)
            ->first();
        if ($check_id == False) {
                $result = DB::table('itemcategory')
                    ->insert([
                        'itemCtg_id' => $itmCtg_id,
                        'itemCtg_description' => $itmCtg_description,
                        'itemCtg_active' => 'yes',
                        'itemCtg_createBy' => Auth::user()->admin_restaurant,
                        'created_at'=>now(),
                        'updated_at'=>now()
                    ]);
                return redirect('/item/item_category');

        } else {
            return redirect('/item/item_category');
        }
    }

    public function active(Request $request)
    {
        $itemCtg_id = request('itemCtg_id');
        $itemCtg_active = DB::table('itemcategory')
            ->select('itemCtg_active')
            ->where('itemCtg_id', '=', $itemCtg_id)
            ->first();
        if ($itemCtg_active->itemCtg_active == 'no') {
            DB::table('itemcategory')
                ->where('itemCtg_id', '=', $itemCtg_id)
                ->update(['itemCtg_active' => 'yes']);
        } else {
            DB::table('itemcategory')
                ->where('itemCtg_id', '=', $itemCtg_id)
                ->update(['itemCtg_active' => 'no']);
        }

        return redirect('/item/item_category');
    }

    public function update(Request $request)
    {
        $itemCtg_id = request('edit_itmCtg_id');
        $itemCtg_description = request('edit_itmCtg_description');


        $update_itemCtg = DB::table('itemcategory')
            ->where('itemCtg_id', '=', $itemCtg_id)
            ->update(['itemCtg_description' => $itemCtg_description]);

        return redirect(url('/item/item_category'));
//        return response($itemCtg_description);
    }

    public function destroy(Request $request)
    {
        $itemCtg_id = request('itemCtg_id');
        $chk_used = DB::table('item')
            ->select('item_category')
            ->where('item_category', '=', $itemCtg_id)
            ->first();
        if ($chk_used == '' ) {
            DB::table('itemcategory')
                ->where('itemCtg_id', '=', $itemCtg_id)
                ->delete();
            return redirect('/item/item_category');
        } else {
            return redirect('/item/item_category');
        }


    }

}
