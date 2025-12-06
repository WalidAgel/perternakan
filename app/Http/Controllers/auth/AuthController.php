<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        // Jika sudah login, redirect sesuai role
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('karyawan.dashboard');
        }

        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'karyawan',
        ]);

        Karyawan::create([
            'user_id' => $user->id,
            'nama' => $user->name,
            'email' => $user->email,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter'
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials, $request->filled('remember'))) {
            return back()->withErrors([
                'login' => 'Email atau password salah'
            ])->withInput($request->only('email'));
        }

        $request->session()->regenerate();
        $user = Auth::user();

        // REDIRECT BERDASARKAN ROLE - STRICT
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'karyawan') {
            return redirect()->route('karyawan.dashboard');
        }

        // Jika role tidak dikenali, logout paksa
        Auth::logout();
        return redirect()->route('login')->withErrors(['login' => 'Role tidak valid']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
