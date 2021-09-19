<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Brian2694\Toastr\Facades\Toastr;

class CustomLoginController extends Controller
{
    public function custom_login()
    {
        return view('frontend.login');
    }
    public function login_post(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
  
        Toastr::error('Login Info Invalid :)','error');
        return back();
    }
}
