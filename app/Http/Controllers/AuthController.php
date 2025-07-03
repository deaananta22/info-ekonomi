<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('halamanlog'); // Pastikan file resources/views/halamanlog.blade.php ada
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Arahkan ke dashboard sesuai role
            return match ($user->role) {
                'kepala' => redirect()->route('kepala.dashboard'),
                'tim' => redirect()->route('tim.dashboard'),
                'ki' => redirect()->route('ki.dashboard'),
                default => redirect()->route('dashboard'),
            };
        }

        return back()->withErrors(['login_error' => 'Email atau password salah']);
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // Dashboard umum
    public function dashboard()
    {
        return view('dashboard');
    }

    // Profile
    public function profile()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate(['password' => 'required|min:5|confirmed']);
        $user = Auth::user();
        $user->update([
            'password' => bcrypt($request->password),
        ]);

        return back()->with('success', 'Password berhasil diperbarui.');
    }
}
