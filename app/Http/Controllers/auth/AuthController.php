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
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah terdaftar.',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal 6 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            ],
        );

        // Simpan user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'karyawan', // default
        ]);

        // Buat data karyawan otomatis untuk user dengan role karyawan
        if ($user->role === 'karyawan') {
            Karyawan::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'email' => $user->email,
                'no_hp' => null,
            ]);
        }

        // Auto Login (harus setelah create)
        Auth::login($user);

        // Buat pesan selamat datang
        $welcome = "Selamat datang {$user->role} {$user->name}";

        // Redirect langsung ke view
        if ($user->role === 'admin') {
            return view('admin.dashboard', [
                'success' => $welcome,
                'user' => $user,
            ]);
        }

        return view('user.dashboard', [
            'success' => $welcome,
            'user' => $user,
        ]);
    }

    /**
     * LOGIN
     */
    public function login(Request $request)
    {
        // Validasi
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ],
            [
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal 6 karakter.',
            ],
        );

        // Cek kredensial
        if (!Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return back()
                ->withErrors([
                    'login' => 'Email atau password salah.',
                ])
                ->withInput($request->only('email'));
        }

        // Regenerate session untuk keamanan
        $request->session()->regenerate();

        // Ambil user
        $user = Auth::user();

        // Pesan welcome
        $welcome = "Selamat datang {$user->role} {$user->name}";

        // Redirect berdasarkan role
        if ($user->role === 'admin') {
            return view('admin.dashboard', [
                'success' => $welcome,
                'user' => $user,
            ]);
        } else {
            return view('user.dashboard', [
                'success' => $welcome,
                'user' => $user,
            ]);
        }
    }

    /**
     * LOGOUT
     */
    public function logout(Request $request)
    {
        // Logout user
        Auth::logout();

        // Invalidate session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}
