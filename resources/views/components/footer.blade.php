<footer class="bg-ungumonascho text-white">
    <div class="mx-10 md:mx-30 max-w-7xl px-6 py-12">
        <div class="flex flex-col gap-10 md:flex-row md:items-start md:justify-between">

            <div class="w-full md:basis-1/2 md:max-w-[50%] md:shrink-0 space-y-4">
                <div class="flex items-center">
                    <span class="flex h-9 w-9 items-center justify-center">
                        <img
                            src="{{ asset('img/monascho-kuning.ico') }}"
                            class="h-9 w-9 object-contain translate-y-px"
                            alt="MonascHerb"
                        >
                    </span>

                    <span class="text-lg font-bold leading-none">
                        MonascHerb
                    </span>
                </div>
                <p class="text-sm text-gray-400 leading-relaxed md:mr-40 text-justify">
                    CV. ARROHMAH MONASCHO sebagai perusahaan minuman kesehatan tanpa bahan pengawet (KIMIA)
                    yang mampu bersaing di pasar Nasional dan Internasional.
                </p>
                <div class="flex items-center gap-3 text-sm text-gray-300 flex-wrap">
                    <span class="border-b-2 border-yellow-300 px-1 py-1">(218) 555-0114</span>
                    <span class="text-gray-500">or</span>
                    <span class="border-b-2 border-yellow-300 px-1 py-1">monaschoo@gmail.com</span>
                </div>
            </div>

            <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-[2fr_1fr] gap-16">
                <div class="space-y-3">
                    <h4 class="text-sm font-semibold">Menu</h4>
                    <ul class="grid grid-cols-2 gap-7 text-sm text-gray-400">
                        <div class="space-y-2">
                            <li><a href="#" class="hover:text-white transition">Beranda</a></li>
                            <li><a href="#" class="hover:text-white transition">Katalog</a></li>
                            <li><a href="#" class="hover:text-white transition">Transaksi</a></li>
                            <li><a href="#" class="hover:text-white transition">Artikel</a></li>
                        </div>
                        @if (session('role') === 'admin')
                            <li>
                                <ul class="space-y-2">
                                    <li><a href="#" class="hover:text-white transition">Pemesanan</a></li>
                                    <li><a href="#" class="hover:text-white transition">Testimoni</a></li>
                                    <li><a href="#" class="hover:text-white transition">Laporan Penjualan</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>

                <div class="w-full space-y-3">
                    <h4 class="text-sm font-semibold">Kategori</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Monascho Cair</a></li>
                        <li><a href="#" class="hover:text-white transition">Monascho Kental</a></li>
                        <li><a href="#" class="hover:text-white transition">Monascho Kapsul</a></li>
                        <li><a href="#" class="hover:text-white transition">Monascho Roll</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="mx-auto md:mx-30 max-w-7xl px-6 py-4 flex flex-col md:flex-row items-center justify-between gap-3 text-xs text-gray-500">
            <span>Monascho eCommerce © 2021. All Rights Reserved.</span>
            {{-- <div class="flex items-center gap-2">
                <span class="border border-gray-600 rounded px-2 py-0.5 text-gray-400">Apple Pay</span>
                <span class="border border-gray-600 rounded px-2 py-0.5 text-gray-400">VISA</span>
                <span class="border border-gray-600 rounded px-2 py-0.5 text-gray-400">Discover</span>
                <span class="border border-gray-600 rounded px-2 py-0.5 text-gray-400">🔒 Secure Payment</span>
            </div> --}}
        </div>
    </div>
</footer>
