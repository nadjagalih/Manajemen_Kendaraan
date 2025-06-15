<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return match (Auth::user()->role) {
                'admin' => redirect('/admin'),
                'kepala_cabang', 'kepala_pusat' => redirect('/approver'),
                default => abort(403, 'Role tidak dikenali'),
            };
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }
}
