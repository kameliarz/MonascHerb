<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="m-20 flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white p-10 rounded-2xl shadow-md space-y-2">
            <form action="{{ $action }}" method="POST" class="space-y-5">
                @csrf

                <h1 class="text-2xl font-bold text-center mb-6">Verifikasi OTP</h1>

                @if ($errors->any())
                    <div class="mb-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-600">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="mb-4 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <p class="text-center text-sm text-gray-800">Masukan 6 digit kode yang telah dikirim melalui email</p>

                @if($mode === 'register')
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">
                            Email
                        </label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $email) }}"
                            readonly
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-500 focus:outline-none"
                        >
                    </div>
                @endif

                <div class="flex items-center justify-center gap-3">
                    <input type="text" maxlength="1"
                        class="otp-input h-12 w-12 rounded-md bg-gray-100 border border-gray-300 text-center text-lg font-semibold outline-none focus:ring-1 focus:ring-gray-400" />

                    <input type="text" maxlength="1"
                        class="otp-input h-12 w-12 rounded-md bg-gray-100 border border-gray-300 text-center text-lg font-semibold outline-none focus:ring-1 focus:ring-gray-400" />

                    <input type="text" maxlength="1"
                        class="otp-input h-12 w-12 rounded-md bg-gray-100 border border-gray-300 text-center text-lg font-semibold outline-none focus:ring-1 focus:ring-gray-400" />

                    <input type="text" maxlength="1"
                        class="otp-input h-12 w-12 rounded-md bg-gray-100 border border-gray-300 text-center text-lg font-semibold outline-none focus:ring-1 focus:ring-gray-400" />

                    <input type="text" maxlength="1"
                        class="otp-input h-12 w-12 rounded-md bg-gray-100 border border-gray-300 text-center text-lg font-semibold outline-none focus:ring-1 focus:ring-gray-400" />

                    <input type="text" maxlength="1"
                        class="otp-input h-12 w-12 rounded-md bg-gray-100 border border-gray-300 text-center text-lg font-semibold outline-none focus:ring-1 focus:ring-gray-400" />
                </div>

                <input type="hidden" name="otp_code" id="otp_code" />
                <p class="text-center text-sm text-gray-800">Kode kadaluarsa dalam 10 menit</p>
                <div class="space-y-1">

                    <button
                        type="submit"
                        class="w-full bg-ungumonascho text-white py-2 rounded-3xl text-sm font-semibold hover:bg-purple-900 transition"
                    >
                        Verifikasi
                    </button>
                </div>
            </form>

            <div class="flex justify-center gap-1 text-sm">
                <p class="text-gray-800">Belum dapat kode?</p>
                <form action="{{ route('otp.resend') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-blue-800 hover:underline">
                        Kirim ulang
                    </button>
                </form>
            </div>
        </div>
    </section>

    <script>
        const inputs = document.querySelectorAll('.otp-input');
        const hiddenInput = document.getElementById('otp_code');

        inputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                input.value = input.value.replace(/[^0-9]/g, '');

                if (input.value && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }

                updateOTP();
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !input.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });

            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pasteData = (e.clipboardData || window.clipboardData)
                    .getData('text')
                    .replace(/[^0-9]/g, '')
                    .slice(0, inputs.length);

                pasteData.split('').forEach((char, i) => {
                    if (inputs[i]) inputs[i].value = char;
                });

                const nextIndex = Math.min(pasteData.length, inputs.length - 1);
                inputs[nextIndex].focus();

                updateOTP();
            });
        });

        function updateOTP() {
            hiddenInput.value = [...inputs].map(input => input.value).join('');
        }
    </script>
</x-layout>
