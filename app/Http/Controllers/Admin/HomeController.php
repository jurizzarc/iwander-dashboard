<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index()
    {
        // return view('admin.home');
        $user = auth()->user();
        // dd($user);

        if($user->hasRole('admin')){
          return view('admin.home');
        }
        else {
          Auth::logout();

          return redirect('/');
          // return view('dashboard');
        }
    }
}
