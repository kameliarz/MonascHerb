<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="mx-auto max-w-6xl px-6 py-8">
        <div class="overflow-hidden rounded-2xl bg-white shadow-md">
            <div class="m-3">
                @if(session('success'))
                    <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-sm text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 rounded-lg bg-red-100 px-4 py-3 text-sm text-red-700">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="flex justify-end mx-7 mt-7">
                <div class="bg-amber-300 p-2 w-49 rounded-full text-center font-semibold hover:bg-yellow-400 text-sm">
                    <a href="https://wa.me/6288234183154" target="_blank">
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                            </svg>
                             Hubungi via WhatsApp
                        </div>
                    </a>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-10 p-8 md:grid-cols-2">
                <div class="flex items-center justify-center">
                    @if($product->foto_produk)
                        <img
                            src="data:image/jpeg;base64,{{ base64_encode($product->foto_produk) }}"
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
                        <p class="text-sm leading-7 text-gray-600">
                            <span class="font-semibold text-gray-800">Deskripsi:</span><br>
                            {{ $product->deskripsi ?: 'Tidak ada deskripsi produk.' }}
                        </p>
                    </div>

                    <div class="mt-6 border-t border-gray-200 pt-6">
                        <form action="{{ route('keranjang.store', $product->id_produk) }}" method="POST" class="flex w-full max-w-md items-center gap-3">
                            @csrf

                            <div class="flex h-10 items-center rounded-full border border-gray-200 bg-white">
                                <button
                                    type="button"
                                    id="minus-btn"
                                    class="flex h-10 w-10 items-center justify-center rounded-l-full text-gray-400 hover:bg-gray-100"
                                >
                                    −
                                </button>

                                <input
                                    type="text"
                                    id="quantity"
                                    name="quantity"
                                    value="1"
                                    min="1"
                                    max="{{ $product->stok }}"
                                    readonly
                                    class="h-10 w-10 border-0 bg-transparent text-center text-sm font-semibold text-gray-800 appearance-none p-0 m-0 leading-10 focus:ring-0
                                    [&::-webkit-inner-spin-button]:appearance-none
                                    [&::-webkit-outer-spin-button]:appearance-none"
                                    >

                                <button
                                    type="button"
                                    id="plus-btn"
                                    class="flex h-10 w-10 items-center justify-center rounded-r-full text-gray-500 hover:bg-gray-100"
                                >
                                    +
                                </button>
                            </div>

                            <button
                                type="submit"
                                class="flex h-10 flex-1 items-center justify-center gap-2 rounded-full bg-ungumonascho px-6 text-sm font-semibold text-white transition hover:bg-purple-950"
                                {{ $product->stok <= 0 ? 'disabled' : '' }}
                            >
                                Add to Cart

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m10.5 0h-13.5l.75 9h12l.75-9z" />
                                </svg>
                            </button>
                        </form>
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
                    <button id="tab-info-btn" type="button"
                        class="border-b-2 border-purple-900 pb-2 font-semibold text-gray-900">
                        Informasi Tambahan
                    </button>

                    <button id="tab-feedback-btn" type="button"
                        class="border-b-2 border-transparent pb-2 text-gray-400 hover:text-gray-600">
                        Customer Feedback
                    </button>
                </div>

                <div id="tab-info-content" class="px-8 py-6">
                    <div class="mx-auto grid max-w-4xl grid-cols-1 gap-6 text-sm text-gray-600 md:grid-cols-3">
                        <div>
                            <p class="font-semibold text-gray-800">Komposisi:</p>
                            <p class="mt-1">{{ $product->komposisi ?: '-' }}</p>
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
        const minusBtn = document.getElementById('minus-btn');
        const plusBtn = document.getElementById('plus-btn');
        const quantityInput = document.getElementById('quantity');

        if (minusBtn && plusBtn && quantityInput) {
            minusBtn.addEventListener('click', () => {
                let value = parseInt(quantityInput.value);
                if (value > 1) {
                    quantityInput.value = value - 1;
                }
            });

            plusBtn.addEventListener('click', () => {
                let value = parseInt(quantityInput.value);
                let max = parseInt(quantityInput.max);

                if (value < max) {
                    quantityInput.value = value + 1;
                }
            });
        }

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
