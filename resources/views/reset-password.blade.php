<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="m-20 flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white p-10 rounded-2xl shadow-md">
            <form method="POST" action="{{ route('password.reset') }}" class="space-y-4">
                @csrf

                <h1 class="text-2xl font-bold text-center mb-6">Membuat Password Baru</h1>

                <input
                    type="password"
                    name="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-600"
                    placeholder="Password baru"
                >
                <div>
                    <input
                        type="password"
                        name="password_confirmation"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-600"
                        placeholder="Konfirmasi password"
                    >
                    @error('password')
                        <p class="mt-1 text-xs text-red-500 flex items-center gap-1 ml-2">
                            <span>⚠</span>
                            {{ $message }}
                        </p>
                    @else
                        <p class="mt-1 text-xs text-gray-500 ml-3">
                            Password harus memiliki minimal 6 karakter
                        </p>
                    @enderror
                </div>
                <button
                    type="submit"
                    class="w-full bg-ungumonascho text-white py-2 rounded-3xl text-sm font-semibold hover:bg-purple-900 transition"
                >
                    Reset
                </button>
            </form>
        </div>
    </section>

</x-layout>

