<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return string
     */
    public function index()
    {
        if (auth()->user()->role == 'admin'){
            return redirect('/admin/dashboard');
        }

        if (auth()->user()->role == 'order'){
            return redirect()->route('dashboard.order');
        }

        if (auth()->user()->role == 'customer'){
            return redirect()->route('dashboard.customer');
        }

        if (auth()->user()->role == 'developer'){
            return redirect()->route('dashboard.developer');
        }

        if (auth()->user()->role == 'sales'){
            return redirect()->route('dashboard.sales');
        }
        //return view('home');
    }
}
