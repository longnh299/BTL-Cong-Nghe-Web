<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SigninController extends Controller
{
    public function signin()
    {
        if(Auth::user()) return redirect(route('index')) ;
        return view('pages.signin');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->except('_token');
        // $credentials = $request->validate([
        //     'name' => 'required',
        //     'password' => 'required|min:6',
        // ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('index'));
        }

        return back()->with('error', __('Thông tin tài khoản hoặc mật khẩu không chính xác'));
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('signin'));
    }
}
