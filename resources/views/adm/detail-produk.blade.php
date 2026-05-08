<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="mx-auto max-w-6xl px-6 py-8">
        <div class="overflow-hidden rounded-2xl bg-white shadow-md">
            <div class="mx-4 mt-4">
                @if (session('success'))
                    <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="grid grid-cols-1 gap-10 p-8 md:grid-cols-2">

                <div class="flex items-center justify-center">
                    @if($product->foto_produk)
                        <img
                            src="data:{{ $product->foto_mime ?? 'image/jpeg' }};base64,{{ base64_encode($product->foto_produk) }}"
                            alt="{{ $product->nama_produk }}"
                            class="max-h-105 object-contain"
                        >
                    @else
                        <div class="flex h-105 w-full items-center justify-center rounded-xl bg-gray-100 text-gray-400">
                            Tidak ada gambar
                        </div>
                    @endif
                </div>

                <div class="flex flex-col">
                    <h1 class="text-3xl font-bold text-gray-900">
                        {{ $product->nama_produk }}
                    </h1>

                    <div class="mt-2 flex items-center gap-2 text-sm text-gray-500">
                        <span class="text-orange-400">★★★★★</span>
                        <span>4 Review</span>
                    </div>

                    <p class="mt-4 text-2xl font-semibold text-gray-800">
                        Rp. {{ number_format($product->harga, 0, ',', '.') }}
                    </p>

                    <div class="mt-6 border-t border-gray-200 pt-6">
                        <p class="text-sm text-gray-600 leading-7">
                            <span class="font-semibold text-gray-800">Deskripsi:</span><br>
                            {{ $product->deskripsi ?: 'Tidak ada deskripsi produk.' }}
                        </p>
                    </div>

                    <div class="mt-6 border-t border-gray-200 pt-6">
                        <div class="mx-auto grid w-full max-w-md grid-cols-2 gap-4">
                            <a href="{{ route('admin.produk.edit', $product->id_produk) }}"
                               class="inline-flex h-12 w-full items-center justify-center gap-2 rounded-full bg-yellow-400 px-6 text-sm font-semibold text-white shadow hover:bg-yellow-500 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213 3 20.25l1.037-4.5L16.862 3.487z" />
                                </svg>
                                Edit Produk
                            </a>

                            <form action="{{ route('admin.produk.destroy', $product->id_produk) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="flex h-12 w-full items-center justify-center gap-2 rounded-full bg-red-500 text-white font-semibold hover:bg-red-600 transition"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M6 7.5h12M9.75 7.5V6a.75.75 0 01.75-.75h3a.75.75 0 01.75.75v1.5m-7.5 0v9.75A2.25 2.25 0 009 19.5h6a2.25 2.25 0 002.25-2.25V7.5"/>
                                    </svg>

                                    Hapus Produk
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="mt-6 border-t border-gray-200 pt-6">
                        <p class="text-sm text-gray-600">
                            <span class="font-semibold text-gray-800">Kategori:</span>
                            {{ $product->kategori ? $product->kategori->nama_kategori : '-' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200">
                <div class="flex justify-center gap-10 px-8 pt-4 text-sm">
                    <button
                        id="tab-info-btn"
                        type="button"
                        class="border-b-2 border-purple-900 pb-2 font-semibold text-gray-900"
                    >
                        Informasi Tambahan
                    </button>

                    <button
                        id="tab-feedback-btn"
                        type="button"
                        class="border-b-2 border-transparent pb-2 text-gray-400 hover:text-gray-600"
                    >
                        Customer Feedback
                    </button>
                </div>

                <div id="tab-info-content" class="px-8 py-6">
                    <div class="mx-auto grid max-w-4xl grid-cols-1 gap-6 text-sm text-gray-600 md:grid-cols-3">
                        <div>
                            <p class="font-semibold text-gray-800">Komposisi:</p>
                            <p class="mt-1">
                                {{ $product->komposisi ?: '-' }}
                            </p>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Status Stok:</p>
                            <p class="mt-1">
                                @if($product->stok > 0)
                                    Tersedia ({{ $product->stok }})
                                @else
                                    Habis
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div id="tab-feedback-content" class="hidden px-8 py-10">
                    <div class="text-center text-sm text-gray-400">
                        Belum ada testimoni.
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        const infoBtn = document.getElementById('tab-info-btn');
        const feedbackBtn = document.getElementById('tab-feedback-btn');
        const infoContent = document.getElementById('tab-info-content');
        const feedbackContent = document.getElementById('tab-feedback-content');

        infoBtn.addEventListener('click', () => {
            infoContent.classList.remove('hidden');
            feedbackContent.classList.add('hidden');

            infoBtn.classList.remove('text-gray-400', 'border-transparent');
            infoBtn.classList.add('text-gray-900', 'border-purple-900', 'font-semibold');

            feedbackBtn.classList.remove('text-gray-900', 'border-purple-900', 'font-semibold');
            feedbackBtn.classList.add('text-gray-400', 'border-transparent');
        });

        feedbackBtn.addEventListener('click', () => {
            feedbackContent.classList.remove('hidden');
            infoContent.classList.add('hidden');

            feedbackBtn.classList.remove('text-gray-400', 'border-transparent');
            feedbackBtn.classList.add('text-gray-900', 'border-purple-900', 'font-semibold');

            infoBtn.classList.remove('text-gray-900', 'border-purple-900', 'font-semibold');
            infoBtn.classList.add('text-gray-400', 'border-transparent');
        });
    </script>
</x-layout>
