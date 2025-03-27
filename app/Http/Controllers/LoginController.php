<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login() 
    {
       return view('login');
    }

    public function getLogin(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        $validated=auth()->attempt([
            'email'=> $request->email,
            'password'=> $request->password,
        ],$request->password);

        if ($validated) {
            return redirect()->route('home')->with('success', 'Login Successfully');
            
        } else {
            return redirect()->back()->with('error', 'Invalid Credentials');
        }
    }
}
