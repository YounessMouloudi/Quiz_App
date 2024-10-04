<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\PlayerSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function index()
    {
        if(Auth::guard('player')->check() || session()->has('sessionData')) {
            return redirect()->route('home');
        }
        else {
            return view('login');
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|string|min:10|max:10',
            // 'phone' => 'required|regex:/^\d{10}$/',
        ]);

        $player = Player::where('email', $request->email)
                  ->where("phone",$request->phone)->first();
        
        if($player) {
            Auth::guard('player')->login($player);
        }
        else {
            $playerExiste = Player::where('email', $request->email)->first();
            
            if ($playerExiste) {
                return back()->withErrors(['email' => 'This email is already in use'])
                ->withInput(); // hadi ila madrtihach mnin ghayrja3 la page ghatl9a les values tmess7o
            }
            
            $player = Player::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'image' => 'profile.jpg',
            ]);  
            
            Auth::guard('player')->login($player);
        }
        
        return redirect()->route("home");
    }

    public function continueWithoutRegister() {
        
        $sessionId = Str::uuid()->toString();

        // $name = 'Player'. Str::random(4);
        $name = 'User_'. rand(1000, 9999);
        $image = 'profile.jpg';
        $score = 0;

        $sessionData = new PlayerSession($sessionId,$name,$image,$score);

        session()->put('sessionData',$sessionData);

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::guard('player')->logout();

        session()->forget('sessionData');

        return redirect()->route('loginPage');
    }
}
