<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\interiorController;
use App\Http\Controllers\interiorPostController;
use App\Http\Controllers\statusController;
use App\Http\Controllers\provinceCityController;
use App\Http\Controllers\colorController;
use App\Http\Controllers\userController;

//----------------------------------login------------------------------------------------------------
Route::get('/login-interior', [interiorController::class,'login'])->name('login');
Route::post('/dashboard-login', [interiorPostController::class,'login_interior'])->name('login_interior');
Route::get('/register-interior', [interiorController::class,'register'])->name('register');
Route::post('/register', [interiorPostController::class, 'register_interior'])->name('register_interior');
Route::get('/logout/interior',[interiorPostController::class, 'logout'])->name('logout');

//----------------------------------dashboard------------------------------------------------------------
Route::get('/dashboard-interior', [interiorController::class,'index_dashboard'])->middleware('auth')->name('index_dashboard');

Route::get('/dashboard-product', [interiorController::class, 'product_dashboard'])->middleware('auth')->name('product_dashboard');
Route::get('/dashboard-list-product', [interiorController::class,'list_product_dashboard'])->middleware('auth')->name('list_product_dashboard');

Route::get('/dashboard-type', [interiorController::class, 'type_dashboard'])->middleware('auth')->name('type_dashboard');
Route::get('/dashboard-list-type', [interiorController::class,'list_type_dashboard'])->middleware('auth')->name('list_type_dashboard');

Route::get('/dashboard-supplier', [interiorController::class, 'supplier_dashboard'])->middleware('auth')->name('supplier_dashboard');
Route::get('/dashboard-list-supplier', [interiorController::class,'list_supplier_dashboard'])->middleware('auth')->name('list_supplier_dashboard');

Route::get('/dashboard-material', [interiorController::class, 'material_dashboard'])->middleware('auth')->name('material_dashboard');
Route::get('/dashboard-list-material', [interiorController::class,'list_material_dashboard'])->middleware('auth')->name('list_material_dashboard');

Route::get('/dashboard-warehouse', [interiorController::class, 'warehouse_dashboard'])->middleware('auth')->name('warehouse_dashboard');
Route::get('/dashboard-list-warehouse', [interiorController::class,'list_warehouse_dashboard'])->middleware('auth')->name('list_warehouse_dashboard');

Route::get('/dashboard-user', [interiorController::class, 'user_dashboard'])->middleware('auth')->name('user_dashboard');
Route::post('/dashboard-add-user', [userController::class, 'add_user'])->middleware('auth')->name('add_user');
Route::get('/dashboard-list-user', [interiorController::class,'list_user_dashboard'])->middleware('auth')->name('list_user_dashboard');
Route::get('/dashboard-edit-list-user/{id}', [interiorController::class, 'edit_list_user'])->middleware('auth')->name('edit_list_user');
Route::post('/dashboard-update-list-user/{id}', [userController::class, 'update_list_user'])->middleware('auth')->name('update_list_user');
Route::get('/dashboard-profile-user', [interiorController::class, 'edit_profile_user'])->middleware('auth')->name('edit_profile_user');
Route::get('/dashboard-profile-user-address/{id}', [interiorController::class, 'edit_profile_address_user'])->middleware('auth')->name('edit_profile_address_user');
Route::post('/dashboard-update-profile-user/{id}', [userController::class, 'update_profile_user'])->middleware('auth')->name('update_profile_user');
Route::post('/dashboard-update-profile-addess-user/{id}', [userController::class, 'update_profile_adress_user'])->middleware('auth')->name('update_profile_adress_user');
//
Route::get('/dashboard-destroy-user/{id}', [userController::class, 'destroy_user'])->middleware('auth')->name('destroy_user');

Route::get('/dashboard-favorite', [interiorController::class, 'favorite_dashboard'])->middleware('auth')->name('favorite_dashboard');
Route::get('/dashboard-list-favorite', [interiorController::class,'list_favorite_dashboard'])->middleware('auth')->name('list_favorite_dashboard');

Route::get('/dashboard-cart', [interiorController::class, 'cart_dashboard'])->middleware('auth')->name('cart_dashboard');
Route::get('/dashboard-list-cart', [interiorController::class,'list_cart_dashboard'])->middleware('auth')->name('list_cart_dashboard');

Route::get('/dashboard-list-province', [interiorController::class,'list_province_dashboard'])->middleware('auth')->name('list_province_dashboard');
Route::post('/dashboard-add-province', [provinceCityController::class, 'add_province'])->middleware('auth')->name('add_province');
Route::get('/dashboard-edit-province/{id}', [interiorController::class, 'edit_province_dashboard'])->middleware('auth')->name('edit_province_dashboard');
Route::post('/dashboard-update-province/{id}', [provinceCityController::class, 'update_province'])->middleware('auth')->name('update_province');
Route::get('/dashboard-destroy-province/{id}', [provinceCityController::class, 'destroy_province'])->middleware('auth')->name('destroy_province');

Route::post('/dashboard-add-city', [provinceCityController::class, 'add_city'])->middleware('auth')->name('add_city');
Route::get('/dashboard-edit-city/{id}', [interiorController::class, 'edit_city_dashboard'])->middleware('auth')->name('edit_city_dashboard');
Route::post('/dashboard-update-city/{id}', [provinceCityController::class, 'update_city'])->middleware('auth')->name('update_city');
Route::get('/dashboard-destroy-city/{id}', [provinceCityController::class, 'destroy_city'])->middleware('auth')->name('destroy_city');

Route::get('/dashboard-comment', [interiorController::class, 'comment_dashboard'])->middleware('auth')->name('comment_dashboard');

Route::get('/dashboard-roles', [interiorController::class, 'roles_dashboard'])->middleware('auth')->name('roles_dashboard');
Route::post('/dashboard-add-roles', [statusController::class, 'add_roles'])->middleware('auth')->name('add_roles');
Route::get('/dashboard-edit-roles/{id}', [interiorController::class, 'edit_roles_dashboard'])->middleware('auth')->name('edit_roles_dashboard');
Route::post('/dashboard-update-rples/{id}', [statusController::class, 'update_roles'])->middleware('auth')->name('update_roles');
Route::get('/dashboard-destroy-roles/{id}', [statusController::class, 'destroy_roles'])->middleware('auth')->name('destroy_roles');

Route::get('/dashboard-status', [interiorController::class, 'status_dashboard'])->middleware('auth')->name('status_dashboard');
Route::post('/dashboard-add-status', [statusController::class, 'add_status'])->middleware('auth')->name('add_status');
Route::get('/dashboard-edit-status/{id}', [interiorController::class, 'edit_status_dashboard'])->middleware('auth')->name('edit_status_dashboard');
Route::post('/dashboard-update-status/{id}', [statusController::class, 'update_status'])->name('update_status');
Route::get('/dashboard-destroy-status/{id}', [statusController::class, 'destroy_status'])->middleware('auth')->name('destroy_status');

Route::get('/dashboard-type-status', [interiorController::class, 'type_status_dashboard'])->middleware('auth')->name('type_status_dashboard');
Route::post('/dashboard-add-type-status',[statusController::class,'add_type_status'])->middleware('auth')->name('add_type_status');
Route::get('/dashboard-edit-type-status/{id}', [interiorController::class, 'edit_type_status_dashboard'])->name('edit_type_status_dashboard');
Route::post('/dashboard-update-type-status/{id}', [statusController::class,'update_type_status'])->middleware('auth')->name('update_type_status');
Route::get('/dashboard-destroy-type-status/{id}', [statusController::class, 'destroy_type_status'])->middleware('auth')->name('destroy_type_status');

Route::get('/dashboard-discount', [interiorController::class, 'discount_dashboard'])->middleware('auth')->name('discount_dashboard');
Route::post('/dashboard-add-discount', [statusController::class, 'add_discount'])->middleware('auth')->name('add_discount');
Route::get('/dashboard-edit-discount/{id}', [interiorController::class, 'edit_discount_dashboard'])->middleware('auth')->name('edit_discount_dashboard');
Route::post('/dashboard-update-discount/{id}', [statusController::class, 'update_discount'])->middleware('auth')->name('update_discount');
Route::get('dashboard-destroy-discount/{id}', [statusController::class, 'destroy_discount'])->middleware('auth')->name('destroy_discount');

Route::get('/dashboard-color', [interiorController::class, 'color_dashboard'])->middleware('auth')->name('color_dashboard');
Route::post('/dashboard-add-color', [colorController::class, 'add_color'])->middleware('auth')->name('add_color');
Route::get('/dashboard-edit-color/{id}', [interiorController::class, 'edit_color_dashboard'])->middleware('auth')->name('edit_color_dashboard');
Route::post('/dashboard-update-color/{id}', [colorController::class, 'update_color'])->middleware('auth')->name('update_color');
Route::get('/dashboard-destroy-color/{id}', [colorController::class, 'destroy_color'])->middleware('auth')->name('destroy_color');


// ---- user
Route::get('/index', [interiorController::class,'index'])->name('index');
Route::get('/product', [interiorController::class,'product'])->name('product');
Route::get('/blog', [interiorController::class,'blog'])->name('blog');