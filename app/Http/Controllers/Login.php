<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Login extends Controller

{
    public function index()
    {
        return view('login');
    }
    public function make_login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Get authenticated user
    
            // Store session data
            session([
                'email' => $user->email,
                'id' => $user->id,
                'name' => $user->name,
                'halqa_id' => $user->halqa_id,
                'role_id' => $user->role_id,
            ]);
    
            return redirect('/dashboard')->with('success', 'Login Successful');
        } else {
            return redirect('/login')->with('error', 'Invalid credentials');
        }
    }
    
    
}
