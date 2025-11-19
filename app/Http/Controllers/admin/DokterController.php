<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    //
    public function index()
    {
        return view('admin.dokter.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nama_dokter' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'password' => 'required|string|min:6',
            ]);

        // 1️⃣ Buat user dulu
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'dokter'
        ]);

        // 2️⃣ Upload foto dokter
        $filename = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/dokter'), $filename); // bisa juga pakai storage:link
        }

        // 3️⃣ Buat record dokter
        Dokter::create([
            'id_users' => $user->id,
            'nama_dokter' => $request->nama_dokter,
            'no_telp' => $request->no_telp,
            'foto' => $filename
        ]);

        return redirect()->route('admin.dokter.index');
    }
}
