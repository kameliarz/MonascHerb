<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\ItemKeranjang;
use App\Models\Produk;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        if (session('role') !== 'pelanggan') {
            return redirect('/login')->with('error', 'Silakan login sebagai pelanggan.');
        }

        $keranjang = Keranjang::firstOrCreate([
            'id_pelanggan' => session('id_pelanggan'),
        ]);

        $items = ItemKeranjang::with('produk')
            ->where('id_keranjang', $keranjang->id_keranjang)
            ->get();

        return view('plg.keranjang', [
            'title' => 'Keranjang',
            'items' => $items,
        ]);
    }

    public function store(Request $request, $id_produk)
    {
        if (session('role') !== 'pelanggan') {
            return redirect('/login')->with('error', 'Silakan login sebagai pelanggan.');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($id_produk);

        if ($produk->stok <= 0) {
            return back()->with('error', 'Stok produk habis.');
        }

        $jumlahBaru = min((int) $request->quantity, $produk->stok);

        $keranjang = Keranjang::firstOrCreate([
            'id_pelanggan' => session('id_pelanggan'),
        ]);

        $item = ItemKeranjang::where('id_keranjang', $keranjang->id_keranjang)
            ->where('id_produk', $id_produk)
            ->first();

        if ($item) {
            $item->jumlah = min($item->jumlah + $jumlahBaru, $produk->stok);
            $item->save();
        } else {
            ItemKeranjang::create([
                'id_keranjang' => $keranjang->id_keranjang,
                'id_produk' => $id_produk,
                'jumlah' => $jumlahBaru,
            ]);
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, $id_item)
    {
        if (session('role') !== 'pelanggan') {
            return redirect('/login');
        }

        $keranjang = Keranjang::where('id_pelanggan', session('id_pelanggan'))->firstOrFail();

        $item = ItemKeranjang::with('produk')
            ->where('id_keranjang', $keranjang->id_keranjang)
            ->where('id_item', $id_item)
            ->firstOrFail();

        if ($request->action === 'plus' && $item->jumlah < $item->produk->stok) {
            $item->jumlah++;
        }

        if ($request->action === 'minus' && $item->jumlah > 1) {
            $item->jumlah--;
        }

        $item->save();

        return back();
    }

    public function destroy($id_item)
    {
        if (session('role') !== 'pelanggan') {
            return redirect('/login');
        }

        $keranjang = Keranjang::where('id_pelanggan', session('id_pelanggan'))->firstOrFail();

        ItemKeranjang::where('id_keranjang', $keranjang->id_keranjang)
            ->where('id_item', $id_item)
            ->delete();

        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
