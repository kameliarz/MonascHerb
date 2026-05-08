<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="px-6 py-6">
        <h1 class="mb-6 text-center text-2xl font-bold text-gray-900">Keranjang Ku</h1>

        @if(session('success'))
            <div id="success-alert" class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-lg border border-neutral-300 bg-white">
            <div class="grid grid-cols-12 border-b border-neutral-300 px-6 py-3 text-xs font-semibold uppercase text-neutral-500">
                <div class="col-span-4 text-center">Product</div>
                <div class="col-span-2 text-center">Harga</div>
                <div class="col-span-2 text-center">Kuantitas</div>
                <div class="col-span-2 text-center">Subtotal</div>
                <div class="col-span-2"></div>
            </div>

            @forelse($items as $item)
                @php
                    $produk = $item->produk;
                    $subtotal = $produk->harga * $item->jumlah;
                @endphp

                <div class="grid grid-cols-12 items-center border-b border-neutral-300 px-6 py-5 text-sm">
                    <div class="col-span-4 flex items-center gap-5">
                        <input
                            type="checkbox"
                            class="item-checkbox rounded border-gray-300 text-yellow-400 focus:ring-yellow-400"
                            data-quantity="{{ $item->jumlah }}"
                            data-subtotal="{{ $subtotal }}"
                        >

                        @if($produk->foto_produk)
                            <img
                                src="data:image/jpeg;base64,{{ base64_encode($produk->foto_produk) }}"
                                class="h-16 w-16 object-contain"
                                alt="{{ $produk->nama_produk }}"
                            >
                        @else
                            <div class="h-16 w-16 rounded bg-gray-100"></div>
                        @endif

                        <span class="font-medium text-gray-800">
                            {{ $produk->nama_produk }}
                        </span>
                    </div>

                    <div class="col-span-2 text-center text-gray-800">
                        Rp. {{ number_format($produk->harga, 0, ',', '.') }}
                    </div>

                    <div class="col-span-2 flex justify-center">
                        <div class="flex items-center rounded-full border border-gray-200 bg-white">
                            <form action="{{ route('keranjang.update', $item->id_item) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="action" value="minus">
                                <button type="submit" class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 text-gray-400">
                                    −
                                </button>
                            </form>

                            <span class="flex h-8 w-8 items-center justify-center text-sm font-semibold">
                                {{ $item->jumlah }}
                            </span>

                            <form action="{{ route('keranjang.update', $item->id_item) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="action" value="plus">
                                <button type="submit" class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 text-gray-500">
                                    +
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="col-span-2 text-center font-semibold text-gray-800">
                        Rp. {{ number_format($subtotal, 0, ',', '.') }}
                    </div>

                    <div class="col-span-2 flex justify-center">
                        <form action="{{ route('keranjang.destroy', $item->id_item) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?')"
                            >

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="text-yellow-400 hover:text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="px-6 py-10 text-center text-sm text-gray-500">
                    Keranjang masih kosong.
                </div>
            @endforelse
        </div>

        @php
            $totalProduk = $items->sum('jumlah');
            $totalHarga = $items->sum(fn($item) => $item->produk->harga * $item->jumlah);
        @endphp

        <div class="mt-10 flex items-center justify-between rounded-lg border border-gray-200 bg-white px-6 py-4">
            <label class="flex items-center gap-4 text-sm text-gray-600">
                <input
                    type="checkbox"
                    id="select-all"
                    class="rounded border-gray-300 text-yellow-400 focus:ring-yellow-400"
                >
                Pilih semua
            </label>

            <div class="flex items-center gap-5">
                <p class="text-sm text-gray-700">
                    Total (<span id="total-produk">0</span> Produk):
                    <span class="ml-2 font-bold text-yellow-400">
                        Rp. <span id="total-harga">0</span>
                    </span>
                </p>

                <button class="rounded-full bg-yellow-400 px-8 py-3 text-sm font-semibold text-white hover:bg-yellow-500">
                    Checkout
                </button>
            </div>
        </div>
    </div>
    <script>
        const itemCheckboxes = document.querySelectorAll('.item-checkbox');
        const selectAll = document.getElementById('select-all');
        const totalProdukEl = document.getElementById('total-produk');
        const totalHargaEl = document.getElementById('total-harga');

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        function updateTotal() {
            let totalProduk = 0;
            let totalHarga = 0;

            itemCheckboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    totalProduk += parseInt(checkbox.dataset.quantity);
                    totalHarga += parseInt(checkbox.dataset.subtotal);
                }
            });

            totalProdukEl.textContent = totalProduk;
            totalHargaEl.textContent = formatRupiah(totalHarga);

            if (selectAll) {
                selectAll.checked = itemCheckboxes.length > 0 &&
                    Array.from(itemCheckboxes).every(checkbox => checkbox.checked);
            }
        }

        itemCheckboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', updateTotal);
        });

        if (selectAll) {
            selectAll.addEventListener('change', () => {
                itemCheckboxes.forEach((checkbox) => {
                    checkbox.checked = selectAll.checked;
                });

                updateTotal();
            });
        }

        updateTotal();

        const successAlert = document.getElementById('success-alert');

        if (successAlert) {
            setTimeout(() => {
                successAlert.classList.add('hidden');
            }, 3000);
        }
    </script>
</x-layout>
