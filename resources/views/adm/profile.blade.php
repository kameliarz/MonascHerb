<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="min-h-screen ">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-[220px_minmax(0,1fr)]">

                <div class="h-fit rounded-md border border-[#e5e5e5] bg-white p-0 shadow-sm">
                    <div class="border-b border-[#f1f1f1] px-4 py-4">
                        <h2 class="text-[16px] font-medium text-[#222]">Navigasi</h2>
                    </div>

                    <div class="p-0">
                        <a
                            href="/admin/profile"
                            class="flex items-center gap-3 border-l-[3px] border-[#5b1a72] bg-[#f3eafb] px-4 py-3 text-[14px] font-medium text-[#2b2230]"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#5b1a72]" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 2a4 4 0 100 8 4 4 0 000-8zm-7 14a7 7 0 1114 0H3z"/>
                            </svg>
                            <span>Data Akun Admin</span>
                        </a>

                        <a
                            href="{{ route('admin.pelanggan.show') }}"
                            class="flex items-center gap-3 px-4 py-3 text-[14px] font-medium text-[#9ca3af] hover:bg-[#faf7fc]"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#b8bcc4]" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M7 9a3 3 0 100-6 3 3 0 000 6zm6 1a4 4 0 100-8 4 4 0 000 8zM1 17a6 6 0 1112 0H1zm12 0a5.98 5.98 0 00-1.268-3.707A5.998 5.998 0 0119 17h-6z"/>
                            </svg>
                            <span>Data Akun Pelanggan</span>
                        </a>
                    </div>
                </div>

                <div class="rounded-md border border-[#e5e5e5] bg-white px-7 py-6 shadow-sm">
                    <h1 class="text-[18px] font-medium text-[#222] border-b border-neutral-300 pb-3">Akun Admin</h1>

                    @if(session('success'))
                        <div class="mt-4 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mt-4 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            <ul class="list-disc pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.profile.update') }}" method="POST" class="mt-6">
                        @csrf
                        @method('PUT')

                        <div class="space-y-5">
                            <div class="grid grid-cols-[140px_1fr] items-center gap-4">
                                <label class="text-sm text-gray-700">Nama Lengkap:</label>
                                <div>
                                    <input
                                        type="text"
                                        name="nama_lengkap"
                                        value="{{ old('nama_lengkap', $admin->nama_lengkap) }}"
                                        class="w-full px-4 py-2 border border-neutral-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-purple-900"
                                    >
                                    @error('nama_lengkap')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-[140px_1fr] items-center gap-4">
                                <label class="text-sm text-gray-700">Username:</label>
                                <div>
                                    <input
                                    type="text"
                                    name="username"
                                    value="{{ old('username', $admin->username) }}"
                                        readonly
                                        class="w-full px-1 py-1 border-0 border-b border-neutral-300 bg-transparent text-sm text-gray-500 focus:outline-none"
                                    >
                                    @error('username')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-[140px_1fr] items-start gap-4">
                                <label class="text-sm text-gray-700 pt-1">Password:</label>

                                <div>
                                    <div class="flex items-center gap-3">
                                        <input
                                            type="password"
                                            value="password_dummy"
                                            readonly
                                            class="w-full px-1 py-1 border-0 border-b border-neutral-300 bg-transparent text-sm text-gray-500 focus:outline-none"
                                            >

                                            <button
                                            type="button"
                                            id="togglePasswordForm"
                                            class="text-xs text-blue-600 hover:underline whitespace-nowrap"
                                            >
                                            Ubah
                                        </button>
                                    </div>

                                    <div id="passwordForm" class="hidden mt-3 space-y-3">
                                        <input
                                        type="password"
                                            name="password_baru"
                                            placeholder="Password baru"
                                            class="w-full px-4 py-2 border border-neutral-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-purple-900"
                                        >

                                        <input
                                            type="password"
                                            name="password_baru_confirmation"
                                            placeholder="Konfirmasi password baru"
                                            class="w-full px-4 py-2 border border-neutral-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-purple-900"
                                            >
                                        </div>

                                        @error('password_baru')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-[140px_1fr] items-center gap-4">
                                <label class="text-sm text-gray-700">Nomor hp:</label>
                                <div>
                                    <input
                                        type="tel"
                                        name="no_hp"
                                        pattern="[0-9]+"
                                        inputmode="numeric"
                                        value="{{ old('no_hp', $admin->no_hp) }}"
                                        class="w-full px-4 py-2 border border-neutral-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-purple-900"
                                    >
                                    @error('no_hp')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button
                                type="submit"
                                class="inline-flex items-center rounded-full bg-[#10b11d] px-6 py-3 text-[14px] font-medium text-white transition hover:bg-[#0e9a19]"
                            >
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
        const togglePasswordForm = document.getElementById('togglePasswordForm');
        const passwordForm = document.getElementById('passwordForm');

        if (togglePasswordForm && passwordForm) {
            togglePasswordForm.addEventListener('click', function () {
                passwordForm.classList.toggle('hidden');

                if (passwordForm.classList.contains('hidden')) {
                    togglePasswordForm.textContent = 'Ubah';
                } else {
                    togglePasswordForm.textContent = 'Batal';
                }
            });
        }
    </script>
</x-layout>
