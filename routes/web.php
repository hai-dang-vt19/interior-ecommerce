<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\interiorController;
use App\Http\Controllers\interiorPostController;


Route::get('/login-interior', [interiorController::class,'login'])->name('login');
Route::post('/dashboard-login', [interiorPostController::class,'login_interior'])->name('login_interior');

Route::get('/register-interior', [interiorController::class,'register'])->name('register');
Route::post('/register', [interiorPostController::class, 'register_interior'])->name('register_interior');
Route::get('/logout/interior',[interiorPostController::class, 'logout'])->name('logout');

Route::get('/dashboard-interior', [interiorController::class,'index_dashboard'])->middleware('auth')->name('index_dashboard');

Route::get('dashboard-product', [interiorController::class, 'product_dashboard'])->middleware('auth')->name('product_dashboard');
Route::get('dashboard-list-product', [interiorController::class,'list_product_dashboard'])->middleware('auth')->name('list_product_dashboard');

// ---- user
Route::get('/index', [interiorController::class,'index'])->name('index');
Route::get('/product', [interiorController::class,'product'])->name('product');
Route::get('/blog', [interiorController::class,'blog'])->name('blog');