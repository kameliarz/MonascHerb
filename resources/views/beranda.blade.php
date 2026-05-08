<x-beranda-layout>
    <x-slot:title>Beranda | MonascHerb</x-slot:title>

    <div class="bg-white font-sans text-[#24172f]">

        @if (session('success'))
            <div class="fixed right-4 top-4 z-50 w-[calc(100%-2rem)] max-w-sm rounded-xl border border-green-200 bg-green-50/95 px-4 py-3 text-sm font-medium text-green-700 shadow-xl shadow-green-900/10 backdrop-blur md:right-8 md:top-8">
                <div class="flex items-start gap-3">
                    <span class="mt-0.5 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-green-500 text-xs text-white">✓</span>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <div class="bg-white font-sans text-[#24172f]">
            <section class="relative isolate flex min-h-120 items-center justify-center overflow-hidden bg-[#21002f] px-5 sm:min-h-162.5 lg:min-h-190">            <div class="absolute left-[39%] top-[57%] -z-10 h-55 w-55 -translate-x-1/2 -translate-y-1/2 rounded-full bg-[#dda745]/60 blur-[45px] sm:h-75 sm:w-75 lg:h-92.5 lg:w-92.5"></div>
                <div class="absolute left-[61%] top-[39%] -z-10 h-62.5 w-62.5 -translate-x-1/2 -translate-y-1/2 rounded-full bg-[#c89648]/70 blur-[55px] sm:h-90 sm:w-90 lg:h-113.75 lg:w-113.75"></div>

                <img
                    src="{{ $heroImage ?? 'img/b-hero.png' }}"
                    alt="Monascho Curcumin Cair"
                    class="relative z-10 mt-4 h-85 w-auto object-contain drop-shadow-[0_35px_45px_rgba(0,0,0,.42)] sm:h-125 lg:h-155"
                >
            </section>

            <section class="relative overflow-hidden bg-white px-5 py-24 sm:px-6 sm:py-32 lg:px-8">
                <div class="absolute left-[7%] top-[22%] h-102.5 w-125 rotate-[-13deg] rounded-[50%] bg-[#eef5df] opacity-80 blur-[2px]"></div>

                <div class="relative mx-auto grid max-w-262.5 items-center gap-14 lg:grid-cols-[1.02fr_.98fr]">
                    <div class="flex items-end justify-center lg:justify-start">
                        <img
                            src="{{ $introImage ?? 'https://placehold.co/500x520/ffffff/222222?text=2+Botol+Produk' }}"
                            alt="Produk Monascho"
                            class="w-full max-w-117.5 object-contain lg:max-w-130"
                        >
                    </div>

                    <div>
                        <div class="mb-3 flex items-center gap-2 text-[12px] font-bold text-[#f3ae14]">
                            <span class="text-[22px] text-[#128d37]">🍃</span>
                            <span>Tentang</span>
                        </div>
                        <h1 class="max-w-130 text-[34px] font-black leading-[1.12] tracking-[-.04em] text-[#202020] sm:text-[42px] lg:text-[48px]">
                            Dari Kisah Kesembuhan Menuju Inovasi Herbal Monascho
                        </h1>
                        <p class="mt-6 max-w-135 text-[13px] leading-[1.9] text-[#706a76]">
                            Monascho lahir dari sebuah perjuangan melawan penyakit yang penuh harapan. Berawal dari kondisi suami Ibu Endah Kurmawati yang mengalami gagal ginjal dan dinyatakan sulit untuk sembuh secara medis, mendorong beliau untuk meracik minuman herbal alami sebagai bentuk ikhtiar dan kepedulian.
                        </p>

                        <div class="mt-8 grid max-w-140 gap-x-10 gap-y-4 sm:grid-cols-2">
                            @foreach (($benefits ?? []) as $benefit)
                                <div class="flex items-center gap-3 text-[12px] font-bold text-[#232323]">
                                    <span class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full border border-[#e4b620] text-[11px] text-[#5e993e]">✓</span>
                                    <span>{{ $benefit }}</span>
                                </div>
                            @endforeach

                            @if (empty($benefits ?? []))
                                <div class="flex items-center gap-3 text-[12px] font-bold text-[#232323]"><span class="inline-flex h-5 w-5 items-center justify-center rounded-full border border-[#e4b620] text-[11px] text-[#5e993e]">✓</span>100% Herbal Alami</div>
                                <div class="flex items-center gap-3 text-[12px] font-bold text-[#232323]"><span class="inline-flex h-5 w-5 items-center justify-center rounded-full border border-[#e4b620] text-[11px] text-[#5e993e]">✓</span>Harga Terjangkau</div>
                                <div class="flex items-center gap-3 text-[12px] font-bold text-[#232323]"><span class="inline-flex h-5 w-5 items-center justify-center rounded-full border border-[#e4b620] text-[11px] text-[#5e993e]">✓</span>Tanpa Bahan Kimia Berbahaya</div>
                                <div class="flex items-center gap-3 text-[12px] font-bold text-[#232323]"><span class="inline-flex h-5 w-5 items-center justify-center rounded-full border border-[#e4b620] text-[11px] text-[#5e993e]">✓</span>Didukung Riset Ilmiah (ELPIJI)</div>
                                <div class="flex items-center gap-3 text-[12px] font-bold text-[#232323]"><span class="inline-flex h-5 w-5 items-center justify-center rounded-full border border-[#e4b620] text-[11px] text-[#5e993e]">✓</span>Solusi Segar &amp; Berkualitas</div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            {{-- JENIS PRODUK --}}
            <section id="produk" class="bg-white px-5 py-16 sm:px-6 sm:py-20 lg:px-8">
                <div class="mx-auto max-w-262.5">
                    <div class="text-center">
                        <div class="mb-2 flex items-center justify-center gap-2 text-[12px] font-bold text-[#f3ae14]">
                            <span class="text-[22px] text-[#128d37]">🍃</span>
                            <span>Produk Kami</span>
                        </div>
                        <h2 class="text-[34px] font-black tracking-[-.04em] text-[#202020] sm:text-[42px]">Jenis Produk</h2>
                    </div>

                    <div class="mt-16 grid gap-12 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($productTypes as $product)
                            <article class="text-center">
                                <div class="relative mx-auto flex h-75 max-w-70 items-center justify-center">
                                    <div class="absolute inset-x-2 bottom-4 top-6 rounded-full bg-[#f3c54e]/55 blur-[35px]"></div>
                                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="relative z-10 max-h-70 w-auto object-contain">
                                </div>
                                <a href="{{ $product['url'] ?? '#produk' }}" class="mt-4 inline-flex min-w-37.5 items-center justify-center rounded-full px-7 py-3 text-[12px] font-bold text-white shadow-sm transition hover:-translate-y-0.5" style="background-color: {{ $product['color'] ?? '#f5a400' }}">
                                    {{ $product['name'] }}

                                </a>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- FAVORITE PRODUCT --}}
            {{-- <section class="bg-white px-5 py-24 sm:px-6 sm:py-32 lg:px-8">
                <div class="mx-auto max-w-262.5">
                    <div class="mb-12">
                        <div class="mb-2 flex items-center gap-2 text-[12px] font-bold text-[#f3ae14]">
                            <span class="text-[22px] text-[#128d37]">🍃</span>
                            <span>Produk Kami</span>
                        </div>
                        <h2 class="text-[34px] font-black tracking-[-.04em] text-[#202020] sm:text-[42px]">Favorit Produk</h2>
                    </div>

                    <div class="grid items-end gap-8 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($favoriteProducts as $product)
                            <article class="relative rounded-[14px] px-7 pb-8 pt-24 text-left shadow-[0_12px_35px_rgba(37,23,28,.10)] {{ !empty($product['featured']) ? 'bg-[#c7ddb9] pt-40 shadow-[0_12px_35px_rgba(79,125,63,.18)]' : 'bg-white' }}">
                                <div class="absolute -top-16 left-1/2 flex h-45 w-45 -translate-x-1/2 items-end justify-center {{ !empty($product['featured']) ? '-top-28 h-65 w-55' : '' }}">
                                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="max-h-full w-auto object-contain drop-shadow-[0_18px_20px_rgba(0,0,0,.16)]">
                                </div>
                                <h3 class="text-[24px] font-black leading-tight tracking-[-.04em] text-[#1f1f1f]">{{ $product['name'] }}</h3>
                                <a href="{{ $product['url'] ?? '#produk' }}" class="mt-7 inline-flex items-center gap-3 rounded-full px-5 py-3 text-[11px] font-bold text-white shadow-sm transition hover:-translate-y-0.5" style="background-color: {{ $product['button_color'] ?? '#f5b400' }}">
                                    <span>Lihat Produk</span>
                                    <span>→</span>
                                </a>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section> --}}

            {{-- SEJARAH --}}
            <section class="bg-white px-5 py-24 sm:px-6 sm:py-32 lg:px-8">
                <div class="mx-auto grid max-w-262.5 items-center gap-14 lg:grid-cols-[1.05fr_.95fr]">
                    <div>
                        <div class="mb-3 flex items-center gap-2 text-[12px] font-bold text-[#f3ae14]">
                            <span class="text-[22px] text-[#128d37]">🍃</span>
                            <span>Tentang Kami</span>
                        </div>
                        <h2 class="text-[38px] font-black tracking-[-.04em] text-[#202020] sm:text-[48px]">Sejarah Monascho</h2>
                        <div class="mt-7 space-y-4 text-[13px] leading-[1.9] text-[#6d6872]">
                            <p>
                                Monascho bermula pada tahun 2015 dari pengalaman pribadi Ibu Endah Kurmawati yang berusaha membantu suaminya yang menderita gagal ginjal. Melalui eksperimen ramuan herbal, terciptalah Monascho yang kemudian membantu pemulihan kondisi suaminya secara bertahap.
                            </p>
                            <p>
                                Pada tahun 2016, Monascho mulai diproduksi secara resmi di bawah CV Ar-Rohmah di Jember. Produk ini semakin dikenal karena manfaatnya dalam membantu mengatasi berbagai masalah kesehatan. Keunggulannya menarik perhatian LIPI, yang menemukan kandungan Monascus purpureus dari Jember sebagai bahan bernilai tinggi.
                            </p>
                            <p>
                                Tahun 2017, Monascho meraih penghargaan dari Kementerian Riset dan Teknologi sebagai start-up inovatif. Sejak saat itu, inovasi di bidang minuman kesehatan terus dikembangkan, termasuk dukungan dari MUI, pajak daerah, serta berbagai pihak terkait.
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-center lg:justify-end">
                        <img src="{{ $historyImage ?? 'https://placehold.co/560x440/cfcfcf/333333?text=Foto+Tim' }}" alt="Foto sejarah Monascho" class="aspect-[1.24/1] w-full max-w-130 rounded-sm object-cover shadow-[0_8px_22px_rgba(0,0,0,.12)]">
                    </div>
                </div>
            </section>

            {{-- TESTIMONI --}}
            {{-- <section class="bg-[#f5f5f5] px-5 py-20 sm:px-6 sm:py-24 lg:px-8">
                <div class="mx-auto max-w-295">
                    <div class="mb-12 flex items-center justify-between gap-6">
                        <h2 class="text-[34px] font-black tracking-[-.04em] text-[#202020] sm:text-[42px]">Testimoni</h2>
                        <a href="{{ $testimonialUrl ?? '#' }}" class="hidden rounded-full bg-[#21002f] px-7 py-3 text-[12px] font-bold text-white transition hover:bg-[#f3ae14] sm:inline-flex">
                            Lihat semua →
                        </a>
                    </div>

                    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($testimonials as $testimonial)
                            <figure class="rounded-sm bg-white p-7 shadow-[0_8px_22px_rgba(0,0,0,.04)]">
                                <div class="text-[42px] font-black leading-none text-[#b8e394]">”</div>
                                <blockquote class="mt-1 min-h-21 text-[12px] leading-[1.8] text-[#6b6571]">
                                    {{ $testimonial['message'] }}
                                </blockquote>
                                <figcaption class="mt-7 flex items-end justify-between gap-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $testimonial['avatar'] }}" alt="{{ $testimonial['name'] }}" class="h-11 w-11 rounded-full object-cover">
                                        <div>
                                            <p class="text-[12px] font-black text-[#1f1f1f]">{{ $testimonial['name'] }}</p>
                                            <p class="text-[10px] text-[#938b99]">{{ $testimonial['role'] ?? 'Customer' }}</p>
                                        </div>
                                    </div>
                                    <div class="whitespace-nowrap text-[13px] text-[#f3ae14]">
                                        @for ($i = 0; $i < ($testimonial['rating'] ?? 5); $i++)
                                            ★
                                        @endfor
                                    </div>
                                </figcaption>
                            </figure>
                        @endforeach
                    </div>
                </div>
            </section> --}}
        </div>
    </div>
</x-beranda-layout>


