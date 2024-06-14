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
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|confirmed'
        ]);

        $passwordReset = DB::table('password_resets')->where('token', $request->token)->first();
        
        if (strlen($request->password) < 8) {
            return back()->withErrors(['password' => 'La contraseña no cumple con los parametros de seguridad.']);
        }
        
        if ($request->password != $request->password_confirmation) {
            return back()->withErrors(['password' => 'La contraseña de confirmación no coinciden.']);
        }

        if (!$passwordReset || Carbon::parse($passwordReset->created_at)->addMinutes(10)->isPast()) {
            return back()->withErrors(['account' => 'El link es invalido o ha expirado.']);
        }

        $user = \App\Models\CustomersAccount::where('mail', $passwordReset->email)->first();
        if (!$user) {
            return back()->withErrors(['account' => 'Cuenta invalida.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')->where('email', $passwordReset->email)->delete();

        return redirect('/login')->with('status', '¡Tu contraseña ha sido restablecida!');
    }
}