<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
class AuthController extends Controller
{
    //
    public function showSignup(){
        return view('sign-up');
    }

    public function submitSignup(Request $request){
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return redirect()->route('login.show')->with('success', 'Registrasi berhasil! Silakan login.');

    }

    public function showSignin(){
        return view('sign-in');
    }
    public function submitSignin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan']);
        }

        if ($user->password !== $request->password) {
            return back()->withErrors(['password' => 'Password salah']);
        }

        // login manual
        Auth::login($user);

        // redirect sesuai role
        return match ($user->role) {
            'admin'  => redirect()->route('admin.dashboard'),
            'dokter' => redirect()->route('dokter.dashboard'),
            'pasien' => redirect()->route('pasien.dashboard'),
            default  => redirect()->route('dashboard'),
        };
    }

    public function logout(Request $request) {
        Auth::logout(); // Hapus sesi login user

        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect()->route('login.show');
    }
}
