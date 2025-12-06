<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Constructor untuk cek role di semua method
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->role !== 'admin') {
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('Admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('Admin.User.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,karyawan'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('Admin.User.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required|in:admin,karyawan'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.user.index')
                ->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }

        $user->delete();

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil dihapus!');
    }
}
