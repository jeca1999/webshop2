<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SellerProfileController extends Controller
{
    public function edit()
    {
        $seller = Auth::guard('seller')->user();
        $user = $seller; 
        return view('selleredit', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\Seller $seller */
        $seller = Auth::guard('seller')->user();

        $request->validate([
            'email' => 'required|email|unique:sellers,email,' . $seller->id,
            'password' => 'nullable|confirmed|min:8',
        ]);

        $seller->email = $request->email;
        if ($request->password) {
            $seller->password = Hash::make($request->password);
        }

        $seller->save(); // ✅ save() recognized now

        return back()->with('status', 'Profile updated!');
    }

    public function destroy(Request $request)
    {
        /** @var \App\Models\Seller $seller */
        $seller = Auth::guard('seller')->user();
        Auth::guard('seller')->logout();
        $seller->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
