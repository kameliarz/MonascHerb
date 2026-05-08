<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="m-20 flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white p-10 rounded-2xl shadow-md">
            <form method="POST" action="/login" class="space-y-4">
                @csrf

                <h1 class="text-2xl font-bold text-center mb-6">Login</h1>

                @if(session('success'))
                    <div class="mb-4 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-600">
                        {{ session('error') }}
                    </div>
                @endif

                <input
                    type="text"
                    name="login"
                    value="{{ old('login') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-600"
                    placeholder="Username atau Email"
                >

                <input
                    type="password"
                    name="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-600"
                    placeholder="Password"
                >

                <p class="text-right text-sm text-gray-500">
                    <a href="/lupa-password" >lupa password?</a>
                </p>

                <button
                    type="submit"
                    class="w-full bg-ungumonascho text-white py-2 rounded-3xl text-sm font-semibold hover:bg-purple-900 transition"
                >
                    Login
                </button>


                <p class="text-center text-sm text-gray-500">
                    Belum punya akun?
                    <a href="/register" class="font-semibold text-gray-800 hover:underline">Register</a>
                </p>
            </form>
        </div>
    </section>
</x-layout>
