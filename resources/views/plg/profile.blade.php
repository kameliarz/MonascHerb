<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="p-6">
        <div class="bg-white mx-4 md:mx-28 shadow-md border border-neutral-300 rounded-lg overflow-hidden">

            <div class="flex justify-between items-center px-6 py-4 border-b border-neutral-200">
                <h3 class="text-base font-semibold text-gray-800">Profil Pelanggan</h3>
            </div>

            @if (session('success'))
                <div class="mx-6 mt-4 px-4 py-2 bg-green-100 text-green-700 rounded text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('plg.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex flex-col md:flex-row gap-10 px-6 py-6">
                    <div class="w-full md:w-1/2 space-y-5">
                        <div class="grid grid-cols-3 items-center gap-4">
                            <label class="text-sm text-gray-700">Nama Lengkap:</label>
                            <div class="col-span-2">
                                <input
                                    type="text"
                                    name="nama_lengkap"
                                    value="{{ old('nama_lengkap', $pelanggan->nama_lengkap) }}"
                                    class="w-full px-4 py-2 border border-neutral-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-purple-900"
                                >
                                @error('nama_lengkap')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-3 items-center gap-4">
                            <label class="text-sm text-gray-700">Username:</label>
                            <div class="col-span-2">
                                <input
                                    type="text"
                                    name="username"
                                    value="{{ old('username', $pelanggan->username) }}"
                                    readonly
                                    class="w-full px-1 py-1 border-0 border-b border-neutral-300 bg-transparent text-sm text-gray-500 focus:outline-none"
                                >
                                @error('username')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-3 items-center gap-4">
                            <label class="text-sm text-gray-700">Email:</label>
                            <div class="col-span-2">
                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email', $pelanggan->email) }}"
                                    readonly
                                    class="w-full px-1 py-1 border-0 border-b border-neutral-300 bg-transparent text-sm text-gray-500 focus:outline-none"
                                >
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-3 items-start gap-4">
                            <label class="text-sm text-gray-700 pt-1">Password:</label>

                            <div class="col-span-2">
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

                        <div class="grid grid-cols-3 items-center gap-4">
                            <label class="text-sm text-gray-700">Nomor Hp:</label>
                            <div class="col-span-2">
                                <input
                                    type="tel"
                                    name="no_hp"
                                    pattern="[0-9]+"
                                    inputmode="numeric"
                                    value="{{ old('no_hp', $pelanggan->no_hp) }}"
                                    class="w-full px-4 py-2 border border-neutral-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-purple-900"
                                >
                                @error('no_hp')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-3 items-center gap-4">
                            <label class="text-sm text-gray-700">Alamat:</label>
                            <div class="col-span-2">
                                <input
                                    type="text"
                                    name="alamat_lengkap"
                                    value="{{ old('alamat_lengkap', $pelanggan->alamat_lengkap) }}"
                                    class="w-full px-4 py-2 border border-neutral-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-purple-900"
                                >
                                @error('alamat_lengkap')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="w-full md:w-1/2 flex flex-col items-center">
                        <img
                            id="previewImage"
                            src="{{ $pelanggan->foto_profil
                                ? 'data:image/jpeg;base64,' . base64_encode($pelanggan->foto_profil)
                                : asset('img/profile-default.jpg') }}"
                            class="w-44 h-44 rounded-full object-cover mb-4"
                        >

                        <label for="foto_profil"
                            class="px-5 py-2 border border-yellow-400 text-yellow-500 rounded-full text-sm cursor-pointer hover:bg-yellow-400 hover:text-white transition">
                            Pilih Gambar
                        </label>

                        <input type="file" id="foto_profil" name="foto_profil" hidden>

                        @error('foto_profil')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="flex justify-end px-6 pb-6">
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-full font-semibold transition">
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
    document.getElementById('foto_profil').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            document.getElementById('previewImage').src = URL.createObjectURL(file);
        }
    });

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
