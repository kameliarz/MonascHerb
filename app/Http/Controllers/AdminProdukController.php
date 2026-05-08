<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AdminProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::with('kategori')->latest('id_produk');
        $kategoris = Kategori::withCount('produk')->get();

        $selectedKategori = $request->kategori;
        $search = $request->search;

        if ($selectedKategori && $selectedKategori !== 'semua') {
            $query->where('id_kategori', $selectedKategori);
        }

        if ($search) {
            $query->where('nama_produk', 'like', '%' . $search . '%');
        }

        $products = $query->paginate(12)->withQueryString();

        return view('adm.katalog', [
            'title' => 'Katalog',
            'products' => $products,
            'kategoris' => $kategoris,
            'selectedKategori' => $selectedKategori,
        ]);
    }

    public function create()
    {
        $kategoris = Kategori::all();

        return view('adm.tambah-produk', [
            'title' => 'Katalog > Tambah Produk',
            'kategoris' => $kategoris,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'komposisi' => 'nullable|string',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'foto_produk' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ], [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'harga.required' => 'Harga produk wajib diisi.',
            'stok.required' => 'Stok produk wajib diisi.',
            'id_kategori.required' => 'Kategori produk wajib dipilih.',
            'nama_produk.string' => 'Nama produk harus berupa teks.',
            'harga.integer' => 'Harga harus berupa angka.',
            'stok.integer' => 'Stok harus berupa angka.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'komposisi.string' => 'Komposisi harus berupa teks.',
            'harga.min' => 'Harga tidak boleh kurang dari 0.',
            'stok.min' => 'Stok tidak boleh kurang dari 0.',
            'nama_produk.max' => 'Nama produk maksimal 100 karakter.',
            'id_kategori.exists' => 'Kategori tidak valid.',
            'foto_produk.image' => 'File harus berupa gambar.',
            'foto_produk.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'foto_produk.max' => 'Ukuran gambar maksimal 4MB.',
        ]);

        $fotoBinary = null;
        $fotoMime = null;

        if ($request->hasFile('foto_produk')) {
            $file = $request->file('foto_produk');
            $fotoBinary = file_get_contents($file->getRealPath());
            $fotoMime = $file->getMimeType();
        }

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'komposisi' => $request->komposisi,
            'id_kategori' => $request->id_kategori,
            'foto_produk' => $fotoBinary
        ]);

        return redirect('/admin/katalog')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show($id)
    {
        $product = Produk::with(['kategori'])->findOrFail($id);

        return view('adm.detail-produk', [
            'title' => 'Katalog > Detail Produk',
            'product' => $product
        ]);
    }

    public function edit($id)
    {
        $product = Produk::findOrFail($id);
        $kategoris = Kategori::all();

        return view('adm.edit-produk', [
            'title' => 'Katalog > Detail Produk > Edit Produk',
            'product' => $product,
            'kategoris' => $kategoris,
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Produk::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'komposisi' => 'nullable|string',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'foto_produk' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ], [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'harga.required' => 'Harga produk wajib diisi.',
            'stok.required' => 'Stok produk wajib diisi.',
            'id_kategori.required' => 'Kategori produk wajib dipilih.',
            'nama_produk.string' => 'Nama produk harus berupa teks.',
            'harga.integer' => 'Harga harus berupa angka.',
            'stok.integer' => 'Stok harus berupa angka.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'komposisi.string' => 'Komposisi harus berupa teks.',
            'harga.min' => 'Harga tidak boleh kurang dari 0.',
            'stok.min' => 'Stok tidak boleh kurang dari 0.',
            'nama_produk.max' => 'Nama produk maksimal 100 karakter.',
            'id_kategori.exists' => 'Kategori tidak valid.',
            'foto_produk.image' => 'File harus berupa gambar.',
            'foto_produk.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'foto_produk.max' => 'Ukuran gambar maksimal 4MB.',
        ]);

        $dataUpdate = [
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'komposisi' => $request->komposisi,
            'id_kategori' => $request->id_kategori,
        ];

        if ($request->hasFile('foto_produk')) {
            $file = $request->file('foto_produk');
            $dataUpdate['foto_produk'] = file_get_contents($file->getRealPath());
            $dataUpdate['foto_mime'] = $file->getMimeType();
        }

        $product->update($dataUpdate);

        return redirect()->route('admin.katalog.show', $product->id_produk)
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $product = Produk::findOrFail($id);

        $product->delete();

        return redirect()->route('admin.katalog')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
