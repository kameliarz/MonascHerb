<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\PlgProfileController;
use App\Http\Controllers\PlgProdukController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\BerandaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/test-email', function () {
    Mail::raw('Ini email test dari Laravel + Mailtrap', function ($message) {
        $message->to('bebas@dummy.com')
                ->subject('Test Email');
    });

    return 'Email berhasil dikirim (cek Mailtrap)';
});

Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])
    ->name('otp.form');

Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])
    ->name('otp.verify');

Route::get('/lupa-password', [AuthController::class, 'showForgotPassword'])
    ->name('password.forgot');

Route::post('/lupa-password', [AuthController::class, 'sendResetOtp'])
    ->name('password.sendOtp');

Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('otp.resend');

Route::get('/verify-reset-password', [AuthController::class, 'showVerifyReset'])
    ->name('password.verify.form');

Route::post('/verify-reset-password', [AuthController::class, 'verifyResetOtp'])
    ->name('password.verify');

Route::get('/reset-password', [AuthController::class, 'showReset'])
    ->name('password.reset.form');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->name('password.reset');

Route::get('/', [BerandaController::class, 'index'])->name('beranda');


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout']);


Route::prefix('admin')->middleware('role:admin')->group(function () {

    Route::get('/beranda', function () {
        if (!session()->has('id_admin') || session('role') !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak');
        }

        return view('adm.beranda', [
            'title' => 'Dashboard Admin'
        ]);
    });

    Route::get('/katalog', function () {
        if (session('role') !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak');
        }

        return app(AdminProdukController::class)->index(request());
    })->name('admin.katalog');

    Route::get('/katalog', [AdminProdukController::class, 'index'])->name('admin.katalog');
    Route::get('/katalog/{id}', [AdminProdukController::class, 'show'])->name('admin.katalog.show');

    Route::get('/produk/tambah', [AdminProdukController::class, 'create'])->name('admin.produk.create');
    Route::post('/produk', [AdminProdukController::class, 'store'])->name('admin.produk.store');

    Route::get('/produk/{id}/edit', [AdminProdukController::class, 'edit'])->name('admin.produk.edit');
    Route::put('/produk/{id}', [AdminProdukController::class, 'update'])->name('admin.produk.update');

    Route::delete('/produk/{id}', [AdminProdukController::class, 'destroy'])->name('admin.produk.destroy');

    Route::get('/profile', [AdminProfileController::class, 'showProfile'])->name('admin.profile.show');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');

    Route::get('/pelanggan', [AdminProfileController::class, 'showPelanggan'])->name('admin.pelanggan.show');
});


Route::prefix('plg')->middleware('role:pelanggan')->group(function (){

    Route::get('/profile', [PlgProfileController::class, 'index'])
        ->name('plg.profile');

    Route::put('/profile', [PlgProfileController::class, 'update'])
    ->name('plg.profile.update');

    Route::get('/katalog', [PlgProdukController::class, 'index'])
        ->name('plg.katalog');

    Route::get('/katalog/{id}', [PlgProdukController::class, 'show'])
    ->name('plg.katalog.show');

    Route::get('/keranjang', [KeranjangController::class, 'index'])
        ->name('plg.keranjang');

    Route::post('/keranjang/tambah/{id_produk}', [KeranjangController::class, 'store'])
        ->name('keranjang.store');

    Route::patch('/keranjang/item/{id_item}', [KeranjangController::class, 'update'])
        ->name('keranjang.update');

    Route::delete('/keranjang/item/{id_item}', [KeranjangController::class, 'destroy'])
        ->name('keranjang.destroy');
});




