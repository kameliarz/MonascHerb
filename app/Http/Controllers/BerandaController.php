<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class BerandaController extends Controller
{
    public function index(): View
    {
        return view('beranda', [


            'logoImage' => asset('img/logo.png'),
            'heroImage' => asset('img/hero-bottle.png'),
            'introImage' => asset('img/intro-products.png'),
            'historyImage' => asset('img/history.png'),

            'cartCount' => 0,
            'cartTotal' => '50.000',

            'benefits' => [
                '100% Herbal Alami',
                'Harga Terjangkau',
                'Tanpa Bahan Kimia Berbahaya',
                'Didukung Riset Ilmiah (ELPIJI)',
                'Solusi Segar & Berkualitas',
            ],

            'productTypes' => [
                [
                    'name' => 'Monascho Cair',
                    'image' => asset('img/product-cair.png'),
                    'color' => '#f5a400',
                    'url' => '#',
                ],
                [
                    'name' => 'Monascho Kental',
                    'image' => asset('img/product-kental.png'),
                    'color' => '#b9b940',
                    'url' => '#',
                ],
                [
                    'name' => 'Monascho Kapsul',
                    'image' => asset('img/product-kapsul.png'),
                    'color' => '#879878',
                    'url' => '#',
                ],
            ],

            'favoriteProducts' => [
                [
                    'name' => 'Curcumin Cair',
                    'image' => asset('images/fav-curcumin-cair.png'),
                    'button_color' => '#f5b400',
                    'url' => '#',
                ],
                [
                    'name' => 'Curhe Cair',
                    'image' => asset('images/fav-curhe-cair.png'),
                    'button_color' => '#62a844',
                    'featured' => true,
                    'url' => '#',
                ],
                [
                    'name' => 'Curcumin Kental',
                    'image' => asset('images/fav-curcumin-kental.png'),
                    'button_color' => '#f5b400',
                    'url' => '#',
                ],
                [
                    'name' => 'Curmix Cair',
                    'image' => asset('images/fav-curmix-cair.png'),
                    'button_color' => '#cf37ad',
                    'url' => '#',
                ],
            ],

            'testimonials' => [
                [
                    'name' => 'Yakyak',
                    'role' => 'Customer',
                    'message' => 'Produk sangat amat bagus, saya sudah sering pesan yang varian kental. Dan saya jarang kambuh, mantap sekali.',
                    'avatar' => 'https://placehold.co/80x80?text=Y',
                    'rating' => 5,
                ],
                [
                    'name' => 'Nur',
                    'role' => 'Customer',
                    'message' => 'Monascho jaya, saya baru pertama kali coba dan ternyata luar biasa, ini pesanan kedua saya.',
                    'avatar' => 'https://placehold.co/80x80?text=N',
                    'rating' => 5,
                ],
                [
                    'name' => 'Robert Fox',
                    'role' => 'Customer',
                    'message' => 'Produk sangat amat bagus, saya sudah sering pesan yang varian kental. Dan saya jarang kambuh, mantap sekali.',
                    'avatar' => 'https://placehold.co/80x80?text=R',
                    'rating' => 5,
                ],
                [
                    'name' => 'Robert Fox',
                    'role' => 'Customer',
                    'message' => 'Produk sangat amat bagus, saya sudah sering pesan yang varian kental. Dan saya sudah sering pesan.',
                    'avatar' => 'https://placehold.co/80x80?text=R',
                    'rating' => 5,
                ],
            ],
        ]);
    }
}
