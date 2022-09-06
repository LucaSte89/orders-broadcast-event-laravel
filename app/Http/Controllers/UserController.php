<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->route('dashboard');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function register(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        try {
            User::create([
                'name' => $request->nome,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } catch(\Exception $e) {

        }
 

        return redirect()->route('dashboard');

    }
}
