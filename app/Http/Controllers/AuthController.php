<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('admin.login');
    }
    public function authenticate(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            if (Auth::user()->role_id == 1){
                return redirect()->route('subjectsList')->with('success','You are successfully logged in');
            }else{
                Auth::logout();
                return redirect()->route('login')->with('error','You are not admin');
            }
        }else{
                return redirect()->route('login')->with('error','Invalid Credentials');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success','You are logged out successfully');
    }
}
