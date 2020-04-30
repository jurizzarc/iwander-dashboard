<?php

namespace App\Http\Controllers;
use Auth;
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
        $this->middleware('role:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $user = auth()->user();

      if($user->hasRole('admin')){
        return view('admin.home');
      }
      else{
        Auth::logout();
        $user->user()->token()->revoke();
        return redirect('/');
        // return view('dashboard');
      }

    }
}
