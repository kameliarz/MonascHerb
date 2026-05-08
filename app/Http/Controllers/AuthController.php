<?php

namespace App\Http\Controllers;

use App\Models\AkunAdmin;
use App\Models\AkunPelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register', [
            'title' => 'Register'
        ]);
    }

    public function showLogin()
    {
        return view('login', [
            'title' => 'Login'
        ]);
    }

    public function showVerifyOtp()
    {
        return view('verify-otp', [
            'title' => 'Verifikasi OTP',
            'action' => route('otp.verify'),
            'email' => session('email'),
            'mode' => 'register',
        ]);
    }

    public function showVerifyReset()
    {
        if (!session('reset_email')) {
            return redirect()->route('password.forgot');
        }

        return view('verify-otp', [
            'title' => 'Verifikasi Reset Password',
            'action' => route('password.verify'),
            'email' => session('reset_email'),
            'mode' => 'reset',
        ]);
    }

    public function showForgotPassword()
    {
        return view('lupa-password', [
            'title' => 'Lupa Password'
        ]);
    }

    public function verifyResetOtp(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|digits:6'
        ], [
            'otp_code.required' => 'Kode OTP harus diisi.',
            'otp_code.digits' => 'Kode OTP harus 6 digit.'
        ]);

        $pelanggan = AkunPelanggan::where('email', session('reset_email'))->first();

        if (!$pelanggan) {
            return redirect()->route('password.forgot')
                ->with('error', 'Session reset tidak valid.');
        }

        if ($pelanggan->otp_code !== $request->otp_code) {
            return back()->with('error', 'Kode OTP salah.');
        }

        if (Carbon::now()->greaterThan($pelanggan->otp_expires_at)) {
            return back()->with('error', 'Kode OTP sudah kedaluwarsa.');
        }

        session(['reset_verified' => true]);

        return redirect()->route('password.reset.form');
    }

    public function verifyOtp(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required|string',
        ]);

        $pelanggan = AkunPelanggan::where('email', $validated['email'])->first();

        if (!$pelanggan) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan.'
            ])->withInput();
        }

        if ($pelanggan->otp_code !== $validated['otp_code']) {
            return back()->withErrors([
                'otp_code' => 'Kode OTP salah.'
            ])->withInput();
        }

        if (Carbon::now()->greaterThan($pelanggan->otp_expires_at)) {
            return back()->withErrors([
                'otp_code' => 'Kode OTP sudah kedaluwarsa.'
            ])->withInput();
        }

        $pelanggan->update([
            'email_verified_at' => Carbon::now(),
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);

        return redirect('/login')->with('success', 'Email berhasil diverifikasi. Silakan login.');
    }

    public function sendResetOtp(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
        ]);

        $login = $request->login;

        $pelanggan = AkunPelanggan::where('email', $login)
            ->orWhere('username', $login)
            ->first();

        if (!$pelanggan) {
            return back()->with('error', 'Email atau username tidak ditemukan.');
        }

        $otp = rand(100000, 999999);

        $pelanggan->update([
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        Mail::raw("Kode OTP kamu: $otp", function ($message) use ($pelanggan) {
            $message->to($pelanggan->email)
                ->subject('Reset Password');
        });

        session([
            'reset_email' => $pelanggan->email
        ]);

        return redirect()->route('password.verify.form');
    }

    public function resendOtp(Request $request)
    {
        $email = session('email') ?? session('reset_email');

        if (!$email) {
            return back()->with('error', 'Email tidak ditemukan.');
        }

        $user = AkunPelanggan::where('email', $email)->first();

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan.');
        }

        $otp = rand(100000, 999999);

        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        Mail::raw("Kode OTP kamu: $otp", function ($message) use ($email) {
            $message->to($email)->subject('Kode OTP Baru');
        });

        return back()->with('success', 'Kode OTP berhasil dikirim ulang.');
    }

    public function showReset()
    {
        if (!session('reset_verified')) {
            return redirect()->route('password.forgot');
        }

        return view('reset-password', ['title' => 'Reset Password']);
    }

    public function resetPassword(Request $request)
    {
        if (!session('reset_verified')) {
            return redirect()->route('password.forgot');
        }

        $request->validate([
            'password' => 'required|min:6|confirmed'
        ], [
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $pelanggan = AkunPelanggan::where('email', session('reset_email'))->first();

        $pelanggan->update([
            'password' => Hash::make($request->password),
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);

        session()->forget(['reset_email', 'reset_verified']);

        return redirect('/login')->with('success', 'Password berhasil diubah');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:50',
            'username' => 'required|string|max:30|unique:akun_pelanggan,username',
            'email' => 'required|email|max:100|unique:akun_pelanggan,email',
            'no_hp' => 'required|string|max:13',
            'alamat_lengkap' => 'required|string|max:255',
            'password' => 'required|min:6|confirmed',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.max' => 'Nama lengkap maksimal 50 karakter.',

            'username.required' => 'Username wajib diisi.',
            'username.max' => 'Username maksimal 30 karakter.',
            'username.unique' => 'Username sudah terdaftar.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 100 karakter.',
            'email.unique' => 'Email sudah terdaftar.',

            'no_hp.required' => 'Nomor telepon wajib diisi.',
            'no_hp.max' => 'Nomor telepon maksimal 13 karakter.',

            'alamat_lengkap.required' => 'Alamat wajib diisi.',
            'alamat_lengkap.max' => 'Alamat maksimal 255 karakter.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $otp = rand(100000, 999999);

        $pelanggan = AkunPelanggan::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'nama_lengkap' => $validated['nama_lengkap'],
            'no_hp' => $validated['no_hp'],
            'alamat_lengkap' => $validated['alamat_lengkap'],
            'otp_code' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(10),
            'email_verified_at' => null,
        ]);

        Mail::raw("Kode OTP kamu adalah: $otp", function ($message) use ($pelanggan) {
            $message->to($pelanggan->email)
                    ->subject('Kode Verifikasi OTP MonascHerb');
        });

        return redirect('/verify-otp')->with('email', $pelanggan->email);
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $login = $request->login;

        $admin = AkunAdmin::where('username', $login)->first();

        if ($admin && $request->password === $admin->password) {
            $request->session()->regenerate();

            $request->session()->put([
                'user_id' => $admin->id_admin,
                'id_admin' => $admin->id_admin,
                'username' => $admin->username,
                'nama_lengkap' => $admin->nama_lengkap,
                'role' => 'admin',
            ]);

            return redirect('/');
        }

        $pelanggan = AkunPelanggan::where('username', $login)
            ->orWhere('email', $login)
            ->first();

        if ($pelanggan && Hash::check($request->password, $pelanggan->password)) {
            if (!$pelanggan->email_verified_at) {
                return back()->with('error', 'Silakan verifikasi email terlebih dahulu.')
                    ->withInput();
            }

            $request->session()->regenerate();

            $request->session()->put([
                'user_id' => $pelanggan->id_pelanggan,
                'id_pelanggan' => $pelanggan->id_pelanggan,
                'username' => $pelanggan->username,
                'nama_lengkap' => $pelanggan->nama_lengkap,
                'role' => 'pelanggan',
            ]);

            return redirect('/');
        }

        return back()
            ->with('error', 'Username/email atau password salah')
            ->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil logout');
    }
}
