<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Result;

class MenuController extends Controller
{
    public function index()
    {
        $branch = DB::table('branch')
            ->select('branch_id', 'branch_restaurant','branch_name')
            ->where('branch_restaurant','=',Auth::user()->admin_restaurant)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('menuhdr')
                    ->whereColumn('menuhdr.branch_id', 'branch.branch_id');
            })
            ->get();
        return view('Menu/menu_list',['branch'=>$branch]);
//        return response($item_category);
    }
    public function menuList()
    {
        $result = DB::table('menuhdr')
            ->join('branch','branch.branch_id','=','menuhdr.branch_id')
            ->select('menuhdr.*','branch.branch_name')
            ->where('menuhdr.MenuHDR_createBy', '=', Auth::user()->admin_restaurant)
            ->get();
        return response($result);
    }

    public function menuDetail()
    {
        $menu_hdr = request('menu_id');
        $result = DB::table('menudtl')
            ->join('menuhdr','menuhdr.MenuHDR_id','=','menudtl.MenuHDR_id')
            ->select('menudtl.*','menuhdr.MenuHDR_description')
            ->where('menuhdr.MenuHDR_createBy', '=', Auth::user()->admin_restaurant)
            ->where('menuhdr.MenuHDR_id','=',$menu_hdr)
            ->get();
        $menu_hdr_desc = DB::table('menuhdr')
            ->select('MenuHDR_description')
            ->where('MenuHDR_id','=',$menu_hdr)
            ->get();
        $item = DB::table('item')
            ->join('itemcategory','itemcategory.itemCtg_id','=','item.item_category')
            ->select('item.*','itemcategory.itemCtg_description')
            ->where('item.create_by', '=', Auth::user()->admin_restaurant)
            ->get();
        return view('Menu/menu_detail',['food'=>$result,'menu_desc'=>$menu_hdr_desc,'menu_id'=>$menu_hdr, 'item'=>$item]);
//        return response($menu_hdr_desc);
    }


    public function store(Request $request)
    {
        $menu_group_description = request('menu_group_description');
        $branch_id = request('menu_branch');

            $result = DB::table('menuhdr')
                ->insert([
                    'MenuHDR_description' => $menu_group_description,
                    'branch_id' => $branch_id,
                    'MenuHDR_startAt'=> now(),
                    'MenuHDR_endAt'=> now(),
                    'MenuHDR_createBy' => Auth::user()->admin_restaurant
                ]);
            return redirect('/menu/menu_list');
    }

    public function detail(Request $request)
    {
        $menu_id = request('menu_id');
        $menu = DB::table('menu')
            ->select('*')
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

    public function storeItemtoMenu(Request $request){
        $menu_id = request('menu_id');
        $item_code = request('item_code');
        foreach($item_code as $item) {
            // Perform actions on each selected item
            $itemStore = DB::table('item')
                ->select('*')
                ->where('item_code', '=', $item)
                ->where('item.create_by', '=', Auth::user()->admin_restaurant)
                ->first();
            $result = DB::table('menudtl')
                ->insert([
                    'MenuHDR_id' => $menu_id,
                    'MenuDtl_itemID' => $itemStore->item_code,
                    'MenuDtl_description' => $itemStore->item_description,
                    'category_code' => $itemStore->item_category,
                    'MenuDtl_price' => $itemStore->item_ref_price,
                    'MenuHDR_createBy' => Auth::user()->admin_restaurant
                ]);
        }

        return redirect('/menu/menu_list/detail/'.$menu_id.'');
    }

    public function MenuDtlList(Request $request){
        $menu_id = request('menu_id');
        $result = DB::table('menudtl')
//            ->join('menuhdr','menuhdr.MenuHDR_id','=','menudtl.MenuDtl_id')
            ->join('itemcategory','itemcategory.itemCtg_id','=','menudtl.category_code')
            ->select('itemcategory.itemCtg_description','menudtl.*')
            ->where('menudtl.MenuHDR_id', '=', $menu_id)
            ->where('menudtl.MenuHDR_createBy', '=', Auth::user()->admin_restaurant)
            ->get();

        return response($result);
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
        $menu_id = request('menu_id');
        $item_price = request('edit_price');
        $item_code = request('edit_item_code');


        $update_menuDtl = DB::table('menudtl')
            ->where('MenuHDR_id', '=', $menu_id)
            ->where('MenuDtl_itemID', '=', $item_code)
            ->update(['MenuDtl_price' => $item_price]);

        return redirect('/menu/menu_list/detail/'.$menu_id.'');
//        return response($item_code);
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
