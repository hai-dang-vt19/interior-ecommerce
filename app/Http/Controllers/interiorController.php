<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class interiorController extends Controller
{
    //------------------------------------------ dash board -----------------------------------------
    public function login()
    {
        return view('dashboards.login');
    }
    public function register()
    {
        return view('dashboards.register');
    }
    public function index_dashboard()
    {
        // if(Auth::user())
        return view('dashboards.index-dashboard');
    }

    //------------------------------------------   client   -----------------------------------------
    public function blog()
    {
        return view('interiors.blog');
    }
    public function index()
    {
        return view('interiors.index');
    }
    public function product()
    {
        return view('interiors.product');
    }
}
