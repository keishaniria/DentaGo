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

    public function show($id)
    {
        $dokter = Dokter::findOrFail($id);
        return view('admin.dokter.detail-dokter', compact('dokter'));
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

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'dokter'
        ]);

        $path = null; 

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('dokter', 'public');
        }

        Dokter::create([
            'id_users' => $user->id,
            'nama_dokter' => $request->nama_dokter,
            'no_telp' => $request->no_telp,
            'foto' => $path 
        ]);

        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil ditambahkan');
    }

    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        return view('admin.dokter.edit-dokter', compact('dokter'));
    }

    public function update(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);

        $request->validate([
            'nama_dokter' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($request->hasFile('foto')) {
            if($dokter->foto && \Storage::exists('public/' . $dokter->foto)) {
                \Storage::delete('public/' . $dokter->foto);
            }

            $filename = $request->file('foto')->store('dokter', 'public');
            $dokter->foto = $filename; 
        }

        $dokter->nama_dokter = $request->nama_dokter;
        $dokter->no_telp = $request->no_telp;
        $dokter->save();
        return redirect()->route('admin.dokter.index');
    }

    public function destroy($id)
    {
        $dokter = Dokter::findOrFail($id);

        if($dokter && $dokter->foto) {
            if(\Storage::exists('public/' . $dokter->foto)) {
                \Storage::delete('public/' . $dokter->foto);
            }
        }

        $dokter->user->delete();
        $dokter->delete();

        return redirect()->route('admin.dokter.index');
    }
}
