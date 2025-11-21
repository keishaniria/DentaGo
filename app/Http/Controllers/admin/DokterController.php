<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Dokter;
use App\Models\User;

class DokterController extends Controller
{
    //
    public function index()
    {
        $dokter = Dokter::all();
        return view('admin.dokter.index', compact('dokter'));
    }

    public function create()
    {
        return view('admin.dokter.tambah-dokter');
    }

    public function store(Request $request)
    {
        $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'nama_dokter' => 'required|string|max:255',
        'no_telp' => 'required|string|max:20',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 1️⃣ Insert user
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password, // <--- 2. PENTING: PASSWORD HARUS DI-HASH!
            'role' => 'dokter'
        ]);

        // 2️⃣ Upload foto dan simpan nama filenya ke variabel $path
        $path = null; 

        if ($request->hasFile('foto')) {
            // File akan disimpan di: storage/app/public/admin/dokter/
            $path = $request->file('foto')->store('dokter', 'public');
        }

        // 3️⃣ Insert ke tabel dokter
        Dokter::create([
            'id_users' => $user->id,
            'nama_dokter' => $request->nama_dokter,
            'no_telp' => $request->no_telp,
            'foto' => $path 
        ]);

        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil ditambahkan'); // Tambahkan with('success') agar ada notifikasi
    }
}
