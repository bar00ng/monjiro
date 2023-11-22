<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function loginAction(Request $request) {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);


        \App\Models\User::where('email', $credentials);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            Alert::success('Success', 'Login success !');
            return to_route('admin.dashboard');
        } else {
            Alert::error('Error', 'Login failed !');
            return back();
        }
    }

    public function register() {}

    public function registerAction() {}

    public function logout(Request $request) {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        Alert::success('Success', 'Log out success !');
        return to_route('login');
    }
}
