<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\interiorController;
use App\Http\Controllers\interiorPostController;

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
Route::get('/dashboard-list-user', [interiorController::class,'list_user_dashboard'])->middleware('auth')->name('list_user_dashboard');

Route::get('/dashboard-favorite', [interiorController::class, 'favorite_dashboard'])->middleware('auth')->name('favorite_dashboard');
Route::get('/dashboard-list-favorite', [interiorController::class,'list_favorite_dashboard'])->middleware('auth')->name('list_favorite_dashboard');

Route::get('/dashboard-cart', [interiorController::class, 'cart_dashboard'])->middleware('auth')->name('cart_dashboard');
Route::get('/dashboard-list-cart', [interiorController::class,'list_cart_dashboard'])->middleware('auth')->name('list_cart_dashboard');

Route::get('/dashboard-list-province', [interiorController::class,'list_province_dashboard'])->middleware('auth')->name('list_province_dashboard');
Route::get('/dashboard-list-city', [interiorController::class,'list_city_dashboard'])->middleware('auth')->name('list_city_dashboard');

Route::get('/dashboard-comment', [interiorController::class, 'comment_dashboard'])->middleware('auth')->name('comment_dashboard');
Route::get('/dashboard-roles', [interiorController::class, 'roles_dashboard'])->middleware('auth')->name('roles_dashboard');
Route::get('/dashboard-status', [interiorController::class, 'status_dashboard'])->middleware('auth')->name('status_dashboard');
Route::get('/dashboard-discount', [interiorController::class, 'discount_dashboard'])->middleware('auth')->name('discount_dashboard');
Route::get('/dashboard-color', [interiorController::class, 'color_dashboard'])->middleware('auth')->name('color_dashboard');


// ---- user
Route::get('/index', [interiorController::class,'index'])->name('index');
Route::get('/product', [interiorController::class,'product'])->name('product');
Route::get('/blog', [interiorController::class,'blog'])->name('blog');