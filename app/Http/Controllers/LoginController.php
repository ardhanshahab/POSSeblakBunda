<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::user() == true) {
            return back()->with('danger', 'You have logged in');
        } else {
            return view('login.index');
        }
    }

    public function authentication(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required|min:8',
        ]);
        $user = Auth::attempt($validatedData);
        if (!$user) {
            return back()->with('danger', 'Login failed');
        }
        
        if (Auth::user()->role == 'Admin') {
            return redirect()->route('admin.index')->with('success', 'You are logged in');
        } elseif (Auth::user()->role == 'Manager') {
            return redirect()->route('manager.index')->with('success', 'You are logged in');
        } else {
            return redirect()->route('kasir.index')->with('success', 'You are logged in');
        }
    }

    public function logout() 
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerate();
        return redirect()->route('login')->with('danger', 'You are logged out');
    }
}
