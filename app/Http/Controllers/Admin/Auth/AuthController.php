<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Termwind\Components\Dd;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);


        if (Auth::attempt($credentials)) {
            // Authentication success, redirect to home or any desired page.
            return redirect()->route('admin.home');
        } else {
            // Authentication failed, redirect back with error message.
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function showForgotPasswordForm()
    {
        return view('admin.auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $response = Password::sendResetLink($request->only('email'));

        return $response == Password::RESET_LINK_SENT
            ? back()->with(['status' => __($response)])
            : back()->withErrors(['email' => __($response)]);
    }

    public function showResetPasswordForm(Request $request, $token)
    {
        return view('admin.auth.passwords.reset', ['token' => $token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);


        $response = Password::reset($request->only(
            'email',
            'password',
            'password_confirmation',
            'token'
        ), function ($users, $password) {

            $users->forceFill([
                'password' => $password
            ])->save();

            // Manually authenticate the user after resetting the password
            Auth::login($users);
        });

        return $response == Password::PASSWORD_RESET
            ? redirect()->route('login')->with(['status' => __($response)])
            : back()->withErrors(['email' => __($response)]);
    }
}
