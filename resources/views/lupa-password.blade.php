<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="m-20 flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white p-10 rounded-2xl shadow-md">
            <form action="{{ route('password.sendOtp') }}" method="POST" class="space-y-4">
                @csrf

                <h1 class="text-2xl font-bold text-center mb-6">Lupa Password</h1>

                <div class="space-y-2">
                    <p class="text-sm text-gray-600">
                        Masukkan username atau email
                    </p>
                    <input
                        type="text"
                        name="login"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-600"
                        placeholder="Username atau Email"
                        required
                    >
                </div>

                <button
                    type="submit"
                    class="w-full bg-ungumonascho text-white py-2 rounded-3xl text-sm font-semibold hover:bg-purple-900 transition"
                >
                    Kirim
                </button>
            </form>
        </div>
    </section>
</x-layout>
