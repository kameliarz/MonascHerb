<nav class="bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            <div class="flex items-center gap-2">
                <a href="/" class="shrink-0 flex items-center gap-2">
                    <img
                        src="{{ asset('img/monascho-ungu.ico') }}"
                        alt="MonascHerb"
                        class="h-8 w-8 object-contain translate-y-px"
                    >

                    <h2 class="text-lg font-semibold leading-none">
                        MonascHerb
                    </h2>
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <x-nav-link href="/" :active="request()->is('/')">
                            Beranda
                        </x-nav-link>

                        @if(session('role') === 'admin')
                            <x-nav-link href="{{ route('admin.katalog') }}" :active="request()->is('admin/katalog*')">
                                Katalog
                            </x-nav-link>
                        @else
                            <x-nav-link href="{{ route('plg.katalog') }}" :active="request()->is('plg/katalog*')">
                                Katalog
                            </x-nav-link>
                        @endif

                        <x-nav-link href="/transaksi" :active="request()->is('transaksi*')">
                            Transaksi
                        </x-nav-link>

                        <x-nav-link href="/artikel" :active="request()->is('artikel*')">
                            Artikel
                        </x-nav-link>

                        @if(session('role') === 'admin')
                            <x-nav-link href="{{ url('/admin/pemesanan') }}" :active="request()->is('admin/pemesanan*')">
                                Pemesanan
                            </x-nav-link>

                            <x-nav-link href="{{ url('/admin/testimoni') }}" :active="request()->is('admin/testimoni*')">
                                Testimoni
                            </x-nav-link>

                            <x-nav-link href="{{ url('/admin/laporan') }}" :active="request()->is('admin/laporan*')">
                                Laporan
                            </x-nav-link>
                        @endif
                    </div>
                </div>
            </div>

            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    @if(session()->has('user_id'))

                        @if(session('role') === 'pelanggan')
                            <a href="{{ route('plg.keranjang') }}"
                                class="relative rounded-full p-1 text-gray-500 hover:text-black focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
                                <span class="sr-only">Cart</span>

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                            </a>
                        @endif

                        <div class="relative ml-3 group">
                            <button type="button"
                                class="relative flex max-w-xs items-center rounded-full focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                                <span class="sr-only">Open user menu</span>

                                <img
                                    src="{{ $navbarFotoProfil
                                        ? 'data:image/jpeg;base64,' . base64_encode($navbarFotoProfil)
                                        : asset('img/profile-default.jpg') }}"
                                    alt="Profile"
                                    class="w-8 h-8 rounded-full object-cover shrink-0 outline -outline-offset-1 outline-black/10"
                                >
                            </button>

                            <div class="absolute right-0 top-full z-10 mt-1 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg outline-1 outline-black/5 hidden group-hover:block">
                                @if(session('role') === 'admin')
                                    <a href="{{ route('admin.profile.show') }}"
                                        class="block px-4 py-2 text-sm text-gray-900 hover:bg-gray-100">
                                        Your profile
                                    </a>
                                @elseif(session('role') === 'pelanggan')
                                    <a href="{{ route('plg.profile') }}"
                                        class="block px-4 py-2 text-sm text-gray-900 hover:bg-gray-100">
                                        Your profile
                                    </a>
                                @endif

                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-900 hover:bg-gray-100">
                                        Log out
                                    </button>
                                </form>
                            </div>
                        </div>

                    @else
                        <div class="flex items-center gap-4">
                            <a href="/login" class="text-sm font-medium text-gray-900 hover:text-purple-700">
                                Login
                            </a>
                            <a href="/register" class="text-sm font-medium text-purple-700 hover:underline">
                                Register
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="-mr-2 flex md:hidden">
                <button id="mobile-menu-button" type="button"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-500 hover:bg-gray-100 hover:text-black focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
                    <span class="sr-only">Open main menu</span>

                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" aria-hidden="true" class="size-6">
                        <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <div id="mobile-menu" hidden class="md:hidden border-t border-gray-100">
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
            <a href="/"
                class="block rounded-md px-3 py-2 text-base font-medium {{ request()->is('/') ? 'text-black bg-gray-100' : 'text-gray-500 hover:bg-gray-100 hover:text-black' }}">
                Beranda
            </a>

            @if(session('role') === 'admin')
                <a href="{{ route('admin.katalog') }}"
                    class="block rounded-md px-3 py-2 text-base font-medium {{ request()->is('admin/katalog*') ? 'text-black bg-gray-100' : 'text-gray-500 hover:bg-gray-100 hover:text-black' }}">
                    Katalog
                </a>
            @else
                <a href="{{ route('plg.katalog') }}"
                    class="block rounded-md px-3 py-2 text-base font-medium {{ request()->is('plg/katalog*') ? 'text-black bg-gray-100' : 'text-gray-500 hover:bg-gray-100 hover:text-black' }}">
                    Katalog
                </a>
            @endif

            <a href="/transaksi"
                class="block rounded-md px-3 py-2 text-base font-medium {{ request()->is('transaksi*') ? 'text-black bg-gray-100' : 'text-gray-500 hover:bg-gray-100 hover:text-black' }}">
                Transaksi
            </a>

            <a href="/artikel"
                class="block rounded-md px-3 py-2 text-base font-medium {{ request()->is('artikel*') ? 'text-black bg-gray-100' : 'text-gray-500 hover:bg-gray-100 hover:text-black' }}">
                Artikel
            </a>

            @if(session('role') === 'admin')
                <a href="{{ url('/admin/pemesanan') }}"
                    class="block rounded-md px-3 py-2 text-base font-medium {{ request()->is('admin/pemesanan*') ? 'text-black bg-gray-100' : 'text-gray-500 hover:bg-gray-100 hover:text-black' }}">
                    Pemesanan
                </a>

                <a href="{{ url('/admin/testimoni') }}"
                    class="block rounded-md px-3 py-2 text-base font-medium {{ request()->is('admin/testimoni*') ? 'text-black bg-gray-100' : 'text-gray-500 hover:bg-gray-100 hover:text-black' }}">
                    Testimoni
                </a>

                <a href="{{ url('/admin/laporan') }}"
                    class="block rounded-md px-3 py-2 text-base font-medium {{ request()->is('admin/laporan*') ? 'text-black bg-gray-100' : 'text-gray-500 hover:bg-gray-100 hover:text-black' }}">
                    Laporan
                </a>
            @endif
        </div>

        @if(session()->has('user_id'))
            <div class="border-t border-black/10 pt-4 pb-3">
                <div class="flex items-center px-5">
                    <div class="shrink-0">
                        <img
                            src="{{ $navbarFotoProfil
                                ? 'data:image/jpeg;base64,' . base64_encode($navbarFotoProfil)
                                : asset('img/profile-default.jpg') }}"
                            alt="Profile"
                            class="w-8 h-8 rounded-full object-cover shrink-0 outline -outline-offset-1 outline-black/10"
                        >
                    </div>

                    <div class="ml-3">
                        <div class="text-base font-medium text-black">
                            {{ session('nama_lengkap') }}
                        </div>
                        <div class="text-sm font-medium text-gray-500">
                            {{ session('username') }}
                        </div>
                    </div>

                    @if(session('role') === 'pelanggan')
                        <a href="{{ route('plg.keranjang') }}"
                            class="relative ml-auto shrink-0 rounded-full p-1 text-gray-500 hover:text-black focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
                            <span class="sr-only">Cart</span>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </a>
                    @endif
                </div>

                <div class="mt-3 space-y-1 px-2">
                    @if(session('role') === 'admin')
                        <a href="{{ route('admin.profile.show') }}"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-black">
                            Your profile
                        </a>
                    @elseif(session('role') === 'pelanggan')
                        <a href="{{ route('plg.profile') }}"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-black">
                            Your profile
                        </a>
                    @endif

                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left rounded-md px-3 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-black">
                            Log out
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="border-t border-black/10 pt-4 pb-3">
                <div class="space-y-1 px-2">
                    <a href="/login"
                        class="block rounded-md px-3 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-black">
                        Login
                    </a>
                    <a href="/register"
                        class="block rounded-md px-3 py-2 text-base font-medium text-purple-700 hover:bg-gray-100">
                        Register
                    </a>
                </div>
            </div>
        @endif
    </div>
</nav>

<script>
    const mobileMenuBtn = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            const isHidden = mobileMenu.hasAttribute('hidden');

            if (isHidden) {
                mobileMenu.removeAttribute('hidden');
                mobileMenuBtn.setAttribute('aria-expanded', 'true');
            } else {
                mobileMenu.setAttribute('hidden', '');
                mobileMenuBtn.removeAttribute('aria-expanded');
            }
        });
    }
</script>
