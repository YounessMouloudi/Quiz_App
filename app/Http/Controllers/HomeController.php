<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // dd(Auth::user());

        $sessionData = $request->session()->get('sessionData');

        if (Auth::guard('player')->check()) {
            $player = Auth::guard('player')->user(); 
            return view('home', compact("player"));
        } 
        else if($sessionData) {
            return view('home',compact("sessionData"));
        }
        else {
            return redirect()->route('loginPage');
        }

    }

}
