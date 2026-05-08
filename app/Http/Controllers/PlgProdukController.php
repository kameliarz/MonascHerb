<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class PlgProdukController extends Controller
{
    public function index(Request $request)
    {
        $selectedKategori = $request->kategori;
        $search = $request->search;

        $query = Produk::query();

        if ($selectedKategori && $selectedKategori !== 'semua') {
            $query->where('id_kategori', $selectedKategori);
        }

        if ($search) {
            $query->where('nama_produk', 'like', '%' . $search . '%');
        }

        $products = $query->paginate(12)->withQueryString();

        $kategoris = Kategori::withCount('produk')->get();

        return view('plg.katalog', [
            'title' => 'Katalog',
            'products' => $products,
            'kategoris' => $kategoris,
            'selectedKategori' => $selectedKategori,
            'resultCount' => $products->count(),
        ]);
    }

    public function show($id)
    {
        $product = Produk::findOrFail($id);

        return view('plg.detail-produk', [
            'title' => 'Katalog > Detail Produk',
            'product' => $product,
        ]);
    }
}
