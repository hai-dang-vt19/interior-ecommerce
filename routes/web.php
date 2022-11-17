<?php

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

Route::get('/login-dashboard', [])->name('login_dashboard');
Route::post('/login', [])->name('login_to_dashboard');

Route::get('/register-dashboard', [])->name('register_dashboard');
Route::post('/register', [])->name('register_to_dashboard');

Route::get('/dashboard-interior', [])->middleware('auth')->name('index_interior');


// ---- user
Route::get('/login-user', [])->name('login-user');
Route::get('/index', )->name('index');
Route::get('/product', )->name('product');
Route::get('/blog', )->name('blog');