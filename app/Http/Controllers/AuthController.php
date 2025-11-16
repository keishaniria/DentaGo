<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    }

    public function showSignin(){
        return view('sign-in');
    }
    public function submitSignin(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', $username)->first();

        if (!$user) {
            return back()->withErrors([
                'username' => 'Username tidak ditemukan atau akun tidak aktif',
            ]);
        }

        if ($user->password !== $password) {
            return back()->withErrors([
                'password' => 'Password salah',
            ]);
        }

        // login manual
        Auth::login($user);

        // redirect sesuai role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'dokter') {
            return redirect()->route('dokter.dashboard');
        } elseif ($user->role === 'pasien') {
            return redirect()->route('pasien.dashboard');
        }
        return redirect()->route('dashboard');
    }
}
