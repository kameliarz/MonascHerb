<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="mx-auto max-w-5xl px-6 py-8">
        <div class="rounded-2xl bg-white p-8 shadow-md">
            <h2 class="mb-8 text-xl font-bold text-gray-800">Edit Produk</h2>

            @if ($errors->any())
                <div class="mb-6 rounded-lg bg-red-100 px-4 py-3 text-sm text-red-700">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.produk.update', $product->id_produk) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-8 md:grid-cols-2">
                @csrf
                @method('PUT')

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Foto Produk</label>

                    <label for="foto_produk" class="relative flex h-72 cursor-pointer flex-col items-center justify-center overflow-hidden rounded-2xl border-2 border-dashed border-purple-400 bg-purple-50 text-center transition hover:border-purple-500 hover:bg-purple-100">

                        @if($product->foto_produk)
                            <img
                                id="preview-image"
                                src="data:{{ $product->foto_mime ?? 'image/jpeg' }};base64,{{ base64_encode($product->foto_produk) }}"
                                alt="{{ $product->nama_produk }}"
                                class="h-full w-full object-cover"
                            >
                            <div id="upload-placeholder" class="hidden flex-col items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mb-3 h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 7.5L12 3m0 0L7.5 7.5M12 3v13.5" />
                                </svg>
                                <span class="text-sm font-medium text-gray-500">Ganti Foto Produk</span>
                                <span class="mt-1 text-xs text-gray-400">PNG, JPG, JPEG, WEBP</span>
                            </div>
                        @else
                            <img id="preview-image" src="" alt="Preview" class="hidden h-full w-full object-cover">
                            <div id="upload-placeholder" class="flex flex-col items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mb-3 h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 7.5L12 3m0 0L7.5 7.5M12 3v13.5" />
                                </svg>
                                <span class="text-sm font-medium text-gray-500">Tambahkan Produk</span>
                                <span class="mt-1 text-xs text-gray-400">PNG, JPG, JPEG, WEBP</span>
                            </div>
                        @endif
                    </label>

                    <input type="file" id="foto_produk" name="foto_produk" class="hidden" accept="image/*">
                </div>

                <div class="space-y-5">
                    <div>
                        <label for="nama_produk" class="mb-1 block text-sm font-medium text-gray-700">Nama Produk</label>
                        <input
                            type="text"
                            id="nama_produk"
                            name="nama_produk"
                            value="{{ old('nama_produk', $product->nama_produk) }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-200"
                        >
                    </div>

                    <div>
                        <label for="harga" class="mb-1 block text-sm font-medium text-gray-700">Harga Produk</label>
                        <input
                            type="number"
                            id="harga"
                            name="harga"
                            value="{{ old('harga', $product->harga) }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-200"
                        >
                    </div>

                    <div>
                        <label for="stok" class="mb-1 block text-sm font-medium text-gray-700">Stok Produk</label>
                        <input
                            type="number"
                            id="stok"
                            name="stok"
                            value="{{ old('stok', $product->stok) }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-200"
                        >
                    </div>

                    <div>
                        <label for="deskripsi" class="mb-1 block text-sm font-medium text-gray-700">Deskripsi Produk</label>
                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            rows="4"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-200"
                        >{{ old('deskripsi', $product->deskripsi) }}</textarea>
                    </div>

                    <div>
                        <label for="id_kategori" class="mb-1 block text-sm font-medium text-gray-700">Kategori Produk</label>
                        <select
                            id="id_kategori"
                            name="id_kategori"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-200"
                        >
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id_kategori }}"
                                    {{ old('id_kategori', $product->id_kategori) == $kategori->id_kategori ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700">Komposisi Produk</label>
                            <textarea
                                id="komposisi"
                                name="komposisi"
                                rows="3"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-200"
                                placeholder="Contoh: Curcumin, Jahe, Kunyit"
                            >{{ old('komposisi', $product->komposisi) }}</textarea>

                        @error('komposisi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-2 text-right">
                        <button
                            type="submit"
                            class="rounded-full bg-ungumonascho px-8 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-purple-800"
                        >
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const fotoInput = document.getElementById('foto_produk');
        const previewImage = document.getElementById('preview-image');
        const uploadPlaceholder = document.getElementById('upload-placeholder');

        if (fotoInput && previewImage && uploadPlaceholder) {
            fotoInput.addEventListener('change', function () {
                const file = this.files[0];

                if (file) {
                    previewImage.src = URL.createObjectURL(file);
                    previewImage.classList.remove('hidden');
                    uploadPlaceholder.classList.add('hidden');
                }
            });
        }
    </script>
</x-layout>
