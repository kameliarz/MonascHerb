<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminProfileController extends Controller
{
    private function checkAdmin()
    {
        if (!session()->has('id_admin') || session('role') !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        return DB::table('akun_admin')
            ->where('id_admin', session('id_admin'))
            ->first();
    }

    public function showProfile()
    {
        $admin = $this->checkAdmin();

        return view('adm.profile', [
            'admin' => $admin,
            'title' => 'Profile Admin',
        ]);
    }

    public function update(Request $request)
    {
        $admin = $this->checkAdmin();

        $request->validate([
            'username' => 'required|string|max:50|unique:akun_admin,username,' . $admin->id_admin . ',id_admin',
            'nama_lengkap' => 'required|string|max:100',
            'no_hp' => 'nullable|regex:/^[0-9]+$/|max:20',
            'password_baru' => 'nullable|string|min:6|confirmed',
        ], [
            'no_hp.regex' => 'Nomor HP hanya boleh berisi angka.',
            'password_baru.min' => 'Password baru minimal 6 karakter.',
            'password_baru.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $data = [
            'username' => $request->username,
            'nama_lengkap' => $request->nama_lengkap,
            'no_hp' => $request->no_hp,
        ];

        if ($request->filled('password_baru')) {
            $data['password'] = $request->password_baru;
        }

        DB::table('akun_admin')
            ->where('id_admin', session('id_admin'))
            ->update($data);

        session([
            'username' => $request->username,
            'nama_lengkap' => $request->nama_lengkap,
        ]);

        return redirect('/admin/profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function showPelanggan()
    {
        $this->checkAdmin();

        $pelanggan = DB::table('akun_pelanggan')->get();

        return view('adm.pelanggan', [
            'title' => 'Data Akun Pelanggan',
            'pelanggan' => $pelanggan,
        ]);
    }
}
