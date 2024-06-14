<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\ResetPasswordMail;

class PasswordResetController extends Controller
{
    public function showResetForm($token)
    {
        return view('frontend.account.reset.restore-password', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $passwordReset = DB::table('password_resets')
            ->where('token', $request->token)
            ->where('email', "eduardchavez302@gmail.com")
            ->first();

        if (!$passwordReset || Carbon::parse($passwordReset->created_at)->addMinutes(10)->isPast()) {
            return back()->withErrors(['email' => 'This password reset token is invalid or has expired.']);
        }

        $user = \App\Models\CustomersAccount::where('mail', "eduardchavez302@gmail.com")->first();
        if (!$user) {
            return back()->withErrors(['email' => 'We can\'t find a user with that email address.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')->where('email', "eduardchavez302@gmail.com")->delete();

        return redirect('/login')->with('status', 'Your password has been reset!');
    }
}