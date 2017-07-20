<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sets;
use App\Movies;
use App\User;

class AdminController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins_count = User::where('isAdmin' , 1)->count(); //gets number of admins
        $sets_count = Sets::count(); //gets number of sets
        $movies_count = Movies::count(); //gets number of movies
        //redirect to dashboard
        return view('admin.index',compact('admins_count','sets_count','movies_count'));
    }

    /**
     * Logout function
     *
     *
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route( 'admin.login' ));
    }

}
