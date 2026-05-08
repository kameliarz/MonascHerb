<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="m-20 flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white p-10 rounded-2xl shadow-md">
            <form method="POST" action="/register" class="space-y-4">
                @csrf

                <h1 class="text-2xl font-bold text-center mb-6">Register</h1>

                <div>
                    <input
                        type="text"
                        name="username"
                        value="{{ old('username') }}"
                        class="w-full px-4 py-2 border  rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-600 {{ $errors->has('username') ? 'border-red-500' : 'border-gray-300' }}"
                        placeholder="Username"
                    >
                    @error('username')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-600 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}"
                        placeholder="Email"
                    >
                    @error('email')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input
                        type="text"
                        name="nama_lengkap"
                        value="{{ old('nama_lengkap') }}"
                        class="w-full px-4 py-2 border  rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-600 {{ $errors->has('nama_lengkap') ? 'border-red-500' : 'border-gray-300' }}"
                        placeholder="Nama Lengkap"
                    >
                    @error('nama_lengkap')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input
                        type="tel"
                        name="no_hp"
                        value="{{ old('no_hp') }}"
                        class="w-full px-4 py-2 border  rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-600 {{ $errors->has('no_hp') ? 'border-red-500' : 'border-gray-300' }}"
                        placeholder="No. Telp"
                    >
                    @error('no_hp')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input
                        type="text"
                        name="alamat_lengkap"
                        value="{{ old('alamat_lengkap') }}"
                        class="w-full px-4 py-2 border  rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-600 {{ $errors->has('alamat_lengkap') ? 'border-red-500' : 'border-gray-300' }}"
                        placeholder="Alamat"
                    >
                    @error('alamat_lengkap')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input
                        type="password"
                        name="password"
                        class="w-full px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-600 {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }}"
                        placeholder="Password"
                    >
                    @error('password')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-600"
                        placeholder="Konfirmasi Password"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full bg-ungumonascho text-white py-2 rounded-3xl text-sm font-semibold hover:bg-purple-900 transition"
                >
                    Buat Akun
                </button>

                <p class="text-center text-sm text-gray-500">
                    Sudah punya akun?
                    <a href="/login" class="font-semibold text-gray-800 hover:underline">Login</a>
                </p>
            </form>
        </div>
    </section>
</x-layout>
