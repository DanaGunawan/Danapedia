<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthControllers extends Controller
{
    public function login_admin()
    {
        return view('admin.auth.login');
    }

    public function auth_login_admin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials) && Auth::user()->is_admin == 1) {
                return redirect('admin/dashboard');
        } else {
            
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }

    public function logout_admin()
    {
        Auth::logout();
        return redirect('/admin');
    }
}
