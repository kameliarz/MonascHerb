<?php

namespace App\Http\Controllers;

use App\Models\AkunPelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PlgProfileController extends Controller
{
    public function index()
    {
        if (!session()->has('id_pelanggan') || session('role') !== 'pelanggan') {
            abort(403, 'Akses ditolak.');
        }

        $pelanggan = AkunPelanggan::findOrFail(session('id_pelanggan'));

        return view('plg.profile', [
            'title' => 'Profil Pelanggan',
            'pelanggan' => $pelanggan,
        ]);
    }

    public function update(Request $request)
    {
        if (!session()->has('id_pelanggan') || session('role') !== 'pelanggan') {
            abort(403, 'Akses ditolak.');
        }

        $pelanggan = AkunPelanggan::findOrFail(session('id_pelanggan'));

        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:akun_pelanggan,username,' . $pelanggan->id_pelanggan . ',id_pelanggan',
            'password_baru' => 'nullable|string|min:6|confirmed',
            'no_hp' => 'nullable|string|max:20',
            'alamat_lengkap' => 'nullable|string|max:255',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'no_hp' => $request->no_hp,
            'alamat_lengkap' => $request->alamat_lengkap,
        ];

        if ($request->filled('password_baru')) {
            $data['password'] = Hash::make($request->password_baru);
        }

        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $data['foto_profil'] = file_get_contents($file->getRealPath());
        }

        $pelanggan->update($data);

        session([
            'username' => $request->username,
            'nama_lengkap' => $request->nama_lengkap,
        ]);

        return redirect()
            ->route('plg.profile')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
