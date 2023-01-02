<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('test',[\App\Http\Controllers\FirebaseController::class,'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
//item category
Route::get('item/item_category', [ItemCategoryController::class, 'index'])->name('itemCategory');
Route::get('item/item_category_list', [ItemCategoryController::class, 'itemCategoryList'])->name('itemCategory_list');
Route::post('item/item_category_store', [ItemCategoryController::class, 'store'])->name('itemCategory_create_store');
Route::post('item/item_category_update', [ItemCategoryController::class, 'update'])->name('itemCategory_create_update');
Route::get('item/item_category_destroy/{itemCtg_id}', [ItemCategoryController::class, 'destroy'])->name('itemCategory_create_destroy');
Route::get('item/item_category_active/{itemCtg_id}', [ItemCategoryController::class, 'active'])->name('itemCategory_create_active');

//item master
Route::get('item/item_master', [ItemController::class, 'index'])->name('itemMaster');
Route::get('item/item_master_list', [ItemController::class, 'itemList'])->name('itemMaster_list');
Route::post('item/item_master_store', [ItemController::class, 'store'])->name('itemMaster_create_store');
Route::post('item/item_master_update', [ItemController::class, 'update'])->name('itemMaster_create_update');
Route::get('item/item_master_destroy/{item_code}', [ItemController::class, 'destroy'])->name('itemMaster_create_destroy');
Route::get('item/item_master_active/{item_code}', [ItemController::class, 'active'])->name('itemMaster_create_active');

//branch
Route::get('branch/branch_list', [BranchController::class, 'index'])->name('BranchList');
Route::get('branch/branch_list_list', [BranchController::class, 'BranchList'])->name('BranchList_list');
Route::post('branch/branch_list_store', [BranchController::class, 'store'])->name('BranchList_create_store');
Route::post('branch/branch_list_update', [BranchController::class, 'update'])->name('BranchList_create_update');
Route::get('branch/branch_list_destroy/{branch_id}', [BranchController::class, 'destroy'])->name('BranchList_create_destroy');
Route::get('branch/branch_list_active/{branch_id}', [BranchController::class, 'active'])->name('BranchList_create_active');

//staff
Route::get('staff/staff_list', [StaffController::class, 'index'])->name('StaffList');
Route::get('staff/staff_detail', [StaffController::class, 'staffDetail'])->name('itemMaster_list');
Route::post('staff/staff_detail_store', [StaffController::class, 'store'])->name('itemMaster_create_store');

//menu
Route::get('menu/menu_list', [MenuController::class, 'index'])->name('MenuList');
Route::get('menu/menu_list_group', [MenuController::class, 'menuList'])->name('MenuList_Group');
Route::post('menu/menu_list_group/store', [MenuController::class, 'store'])->name('MenuList_Group_store');
Route::get('menu/menu_list/detail/{menu_id}', [MenuController::class, 'menuDetail'])->name('MenuList_Group');


// logout
Route::get('logout', function () {
    Auth::logout();
//        auth()->logout();
    Session()->flush();
    return Redirect::to('login');
})->name('logout');
