<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\AkunPelanggan;
use App\Models\AkunAdmin;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
        $navbarFotoProfil = null;

        if (session('role') === 'pelanggan' && session()->has('id_pelanggan')) {
            $user = AkunPelanggan::find(session('id_pelanggan'));
            $navbarFotoProfil = $user?->foto_profil;
        }

        if (session('role') === 'admin' && session()->has('user_id')) {
            $user = AkunAdmin::find(session('user_id'));
            $navbarFotoProfil = $user?->foto_profil;
        }

        $view->with('navbarFotoProfil', $navbarFotoProfil);
    });
    }
}
