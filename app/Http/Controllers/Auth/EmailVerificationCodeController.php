<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class EmailVerificationCodeController extends Controller
{
    public function showForm()
    {
        return view('auth.verify-code');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $user = Auth::user();
        if ($user && $user->email_verification_code == $request->code) {
            $user->email_verified_at = now();
            $user->email_verification_code = null;
            $user->save();
            return redirect()->route('client.dashboard')->with('status', 'Email verified successfully!');
        }
        return back()->withErrors(['code' => 'Invalid verification code.']);
    }
}
