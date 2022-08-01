<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::check())
            return redirect(route('area.index'));

        return view('area.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials_login = [
            'login' => $request->login,
            'password' => $request->password,
        ];
        $credentials_email = [
            'email' => $request->login,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials_login, (bool) $request->remember) ||
            Auth::attempt($credentials_email, (bool) $request->remember)) {
            $request->session()->regenerate();
            return redirect(route('area.index'));
        }

        return redirect(route('area.login'))->onlyInput('login')->withErrors(['login_failed' => __('area.login_failed')]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('area.login'));
    }
}
