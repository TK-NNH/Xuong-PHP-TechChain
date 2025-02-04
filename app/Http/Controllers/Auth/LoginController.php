<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required',],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->type === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        \request()->session()->invalidate();
        return redirect('/');
    }
    public function verify($token)
    {
        $user = User::query()->where('emial_verified_at', null)
            ->where('email', base64_decode($token))->first();
        if ($user) {
            $user->update(['email_verified_at' => Carbon::now()]);
            Auth::login($user);
            return redirect()->route('index');
        }
    }

}
