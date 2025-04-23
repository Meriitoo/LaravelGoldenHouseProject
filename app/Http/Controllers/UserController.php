<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
  
    function store(Request $request)
    {

        $validated = request()->validate([
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'psw-repeat' => 'required|same:password',
        ]);

        User::create($validated);
        return redirect()->route('login')->with('success', 'You registered succesfully!');
        // return back()->with('success', 'Thank you for your reply');
        //dd($request->all());

    }

    // Login
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validated)) {
            return redirect()->route('home');
        } else {
            return back()->with('error', 'Invalid credentials');
        }
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
