<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function adminLogin(){
       return view('admin-panel.admin-login');
    }
    public function adminLoginCheck(Request $req){
        $req->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $req->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('adminDashboard');  
        }
        return redirect()->back()->with('error','Login failed. Please check your email ID and password and try again.');
    }
}