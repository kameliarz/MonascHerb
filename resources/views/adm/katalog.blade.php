<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="px-6 py-6">
        <div class="mb-4 flex items-center justify-between">
            <button
                type="button"
                id="toggle-filter-btn"
                class="inline-flex items-center gap-2 rounded-3xl bg-ungumonascho px-4 py-2 text-sm font-semibold text-white shadow hover:bg-purple-800"
            >
                Filter
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h18M6.75 12h10.5M10.5 19.5h3" />
                </svg>
            </button>

            <div class="flex items-center gap-3">
                <form method="GET" action="{{ route('admin.katalog') }}">
                    <div class="flex overflow-hidden rounded-xl border border-gray-300 bg-white">

                        <div class="flex items-center px-4 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>

                        @if(request('kategori'))
                            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                        @endif

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari"
                            class="w-64 border-0 px-2 py-2.5 text-sm focus:outline-none focus:ring-0"
                        >

                        <button
                            type="submit"
                            class="bg-yellow-400 px-6 text-sm font-semibold text-white transition hover:bg-yellow-500"
                        >
                            Cari
                        </button>
                    </div>
                </form>

                <a href="{{ route('admin.produk.create') }}"
                class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                    Tambahkan Produk
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </a>
            </div>
        </div>

        @if($selectedKategori && $selectedKategori !== 'semua')
            @php
                $kategoriAktif = $kategoris->firstWhere('id_kategori', (int) $selectedKategori);
            @endphp

            <div id="active-filter-bar" class="mb-6 hidden items-center gap-2 text-sm text-gray-600">
                <span class="text-gray-400">Filter aktif:</span>
                <span class="inline-flex items-center gap-2 rounded-md bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">
                    {{ $kategoriAktif?->nama_kategori ?? 'Kategori' }}
                    <a href="{{ route('admin.katalog') }}" class="text-gray-400 hover:text-red-500">×</a>
                </span>
            </div>
        @endif

        @if(session('success'))
            <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex gap-6">
            <aside id="filter-panel" class="w-72 shrink-0 rounded-xl bg-white p-5 shadow-sm self-start">
                <form method="GET" action="{{ route('admin.katalog') }}" id="filter-form">
                    <div>
                        <h3 class="mb-4 text-sm font-semibold text-gray-800">Semua Kategori</h3>

                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        <div class="space-y-3 text-sm text-gray-600">
                            <label class="flex items-center gap-2">
                                <input
                                    type="radio"
                                    name="kategori"
                                    value="semua"
                                    {{ !$selectedKategori || $selectedKategori === 'semua' ? 'checked' : '' }}
                                    class="border-gray-300 text-yellow-500 accent-ungumonascho focus:ring-yellow-400"
                                >
                                Semua Produk
                            </label>

                            @foreach($kategoris as $kategori)
                                <label class="flex items-center gap-2">
                                    <input
                                        type="radio"
                                        name="kategori"
                                        value="{{ $kategori->id_kategori }}"
                                        {{ (string) $selectedKategori === (string) $kategori->id_kategori ? 'checked' : '' }}
                                        class="border-gray-300 text-yellow-500 accent-ungumonascho focus:ring-yellow-400"
                                    >
                                    {{ $kategori->nama_kategori }} ({{ $kategori->produk_count }})
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8 border-t border-gray-100 pt-6">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-sm font-semibold text-gray-800">Rating</h3>
                            <button type="button" class="text-xs text-gray-400">⌃</button>
                        </div>

                        <div class="space-y-2 text-sm text-gray-500">
                            <label class="flex items-center gap-2">
                                <input type="checkbox" class="border-gray-300 accent-ungumonascho">
                                <span class="text-orange-400">★★★★★</span>
                                <span>5.0</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" class="border-gray-300 accent-ungumonascho">
                                <div class="flex items-center">
                                    <span class="text-orange-400">★★★★</span>
                                    <span class="text-gray-300">★</span>
                                </div>
                                <span class="text-sm text-gray-600">4.0 & up</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" class="border-gray-300 accent-ungumonascho">
                                <div class="flex items-center">
                                    <span class="text-orange-400">★★★</span>
                                    <span class="text-gray-300">★★</span>
                                </div>
                                <span>3.0 & up</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" class="border-gray-300 accent-ungumonascho">
                                <div class="flex items-center">
                                    <span class="text-orange-400">★★</span>
                                    <span class="text-gray-300">★★★</span>
                                </div>
                                <span>2.0 & up</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" class="border-gray-300 accent-ungumonascho">
                                <div class="flex items-center">
                                    <span class="text-orange-400">★</span>
                                    <span class="text-gray-300">★★★★</span>
                                </div>
                                <span>1.0 & up</span>
                            </label>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center gap-3">
                        <button
                            type="submit"
                            class="inline-flex rounded-3xl bg-yellow-400 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-yellow-500"
                        >
                            Terapkan
                        </button>

                        <a href="{{ route('admin.katalog') }}"
                           class="inline-flex rounded-3xl border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50">
                            Reset
                        </a>
                    </div>
                </form>
            </aside>

            <section class="flex-1">
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                    @forelse($products as $product)
                        <a href="{{ route('admin.katalog.show', $product->id_produk) }}"
                        class="group block overflow-hidden rounded-xl border border-gray-200 bg-white p-4 shadow-sm transition hover:border-gray-500 hover:shadow-md">

                            <div class="relative flex h-56 items-center justify-center overflow-hidden rounded-lg bg-transparent">
                                @if($product->stok === 0)
                                    <div class="absolute left-1 top-1 z-10 rounded-md bg-neutral-900 px-2 py-1 text-sm font-medium text-white shadow">
                                        stok kosong
                                    </div>
                                @endif

                                @if($product->foto_produk)
                                    <img
                                        src="data:{{ $product->foto_mime ?? 'image/jpeg' }};base64,{{ base64_encode($product->foto_produk) }}"
                                        alt="{{ $product->nama_produk }}"
                                        class="max-h-full max-w-full object-contain"
                                    >
                                @else
                                    <div class="flex h-full w-full items-center justify-center rounded-lg bg-gray-50 text-sm text-gray-400">
                                        Tidak ada gambar
                                    </div>
                                @endif
                            </div>

                            <div class="mt-4">
                                <h4 class="line-clamp-2 text-base font-medium leading-snug text-black transition group-hover:text-yellow-500">
                                    {{ $product->nama_produk }}
                                </h4>

                                <p class="mt-1 text-lg font-semibold text-black">
                                    Rp. {{ number_format($product->harga, 0, ',', '.') }}
                                </p>

                                <div class="mt-2 flex items-center text-sm">
                                    <span class="text-orange-400">★★★★</span>
                                    <span class="text-gray-300">★</span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="w-full rounded-lg bg-white p-6 text-center text-gray-500 shadow-sm">
                            Tidak ada produk yang cocok dengan filter.
                        </div>
                    @endforelse
                </div>
                @if ($products->hasPages())
                    <div class="mt-8 flex items-center justify-center gap-3">
                        @if ($products->onFirstPage())
                            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </span>
                        @else
                            <a href="{{ $products->previousPageUrl() }}"
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-gray-700 transition hover:bg-yellow-400 hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                        @endif

                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            @if ($page == $products->currentPage())
                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-yellow-400 text-sm font-semibold text-white">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                class="flex h-10 w-10 items-center justify-center rounded-full text-sm font-medium text-gray-600 transition hover:bg-gray-100">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach

                        @if ($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}"
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-white text-gray-700 shadow-sm ring-1 ring-gray-200 transition hover:bg-yellow-400 hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @else
                            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        @endif
                    </div>
                @endif
            </section>
        </div>
    </div>

    <script>
        const toggleFilterBtn = document.getElementById('toggle-filter-btn');
        const filterPanel = document.getElementById('filter-panel');
        const activeFilterBar = document.getElementById('active-filter-bar');

        function updateActiveFilterVisibility() {
            if (!filterPanel || !activeFilterBar) return;

            if (filterPanel.classList.contains('hidden')) {
                activeFilterBar.classList.remove('hidden');
                activeFilterBar.classList.add('flex');
            } else {
                activeFilterBar.classList.add('hidden');
                activeFilterBar.classList.remove('flex');
            }
        }

        if (toggleFilterBtn && filterPanel) {
            toggleFilterBtn.addEventListener('click', () => {
                filterPanel.classList.toggle('hidden');
                updateActiveFilterVisibility();
            });
        }

        updateActiveFilterVisibility();
    </script>
</x-layout>
