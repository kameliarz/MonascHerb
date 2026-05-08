<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="min-h-screen py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-[220px_minmax(0,1fr)]">

                <div class="h-fit rounded-md border border-[#e5e5e5] bg-white p-0 shadow-sm">
                    <div class="border-b border-[#f1f1f1] px-4 py-4">
                        <h2 class="text-[16px] font-medium text-[#222]">Navigation</h2>
                    </div>

                    <div class="p-0">
                        <a
                            href="{{ route('admin.profile.show') }}"
                            class="flex items-center gap-3 px-4 py-3 text-[14px] font-medium text-[#9ca3af]"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#b8bcc4]" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 2a4 4 0 100 8 4 4 0 000-8zm-7 14a7 7 0 1114 0H3z"/>
                            </svg>
                            <span>Data Akun Admin</span>
                        </a>

                        <a
                            href="{{ route('admin.pelanggan.show') }}"
                            class="flex items-center gap-3 border-l-[3px] border-[#5b1a72] bg-[#f3eafb] px-4 py-3 text-[14px] font-medium text-[#2b2230]"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#5b1a72]" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M7 9a3 3 0 100-6 3 3 0 000 6zm6 1a4 4 0 100-8 4 4 0 000 8zM1 17a6 6 0 1112 0H1zm12 0a5.98 5.98 0 00-1.268-3.707A5.998 5.998 0 0119 17h-6z"/>
                            </svg>
                            <span>Data Akun Pelanggan</span>
                        </a>
                    </div>
                </div>

                <div class="rounded-md border border-[#e5e5e5] bg-white shadow-sm">
                    <div class="border-b border-[#f1f1f1] px-5 py-4">
                        <h1 class="text-[18px] font-medium text-[#222]">Pelanggan</h1>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full border-separate border-spacing-0">
                            <thead>
                                <tr class="bg-[#f5f5f5] text-left">
                                    <th class="px-5 py-3 text-[11px] font-semibold tracking-wide text-[#666]">ID</th>
                                    <th class="px-5 py-3 text-[11px] font-semibold tracking-wide text-[#666]">Email</th>
                                    <th class="px-5 py-3 text-[11px] font-semibold tracking-wide text-[#666]">Username</th>
                                    <th class="px-5 py-3 text-[11px] font-semibold tracking-wide text-[#666]">Nama Lengkap</th>
                                    <th class="px-5 py-3 text-[11px] font-semibold tracking-wide text-[#666]">Alamat</th>
                                    <th class="px-5 py-3 text-[11px] font-semibold tracking-wide text-[#666]">No Telfon</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pelanggan as $item)
                                    <tr class="border-t border-[#f1f1f1] odd:bg-white even:bg-[#f7f7f7]">
                                        <td class="px-5 py-3 text-[13px] text-[#444]">{{ $item->id_pelanggan }}</td>
                                        <td class="px-5 py-3 text-[13px] text-[#444]">{{ $item->email }}</td>
                                        <td class="px-5 py-3 text-[13px] text-[#444]">{{ $item->username }}</td>
                                        <td class="px-5 py-3 text-[13px] text-[#444]">{{ $item->nama_lengkap ?? '-' }}</td>
                                        <td class="px-5 py-3 text-[13px] text-[#444]">{{ $item->alamat_lengkap ?? '-' }}</td>
                                        <td class="px-5 py-3 text-[13px] text-[#444]">{{ $item->no_hp ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-5 py-6 text-center text-[13px] text-gray-500">
                                            Belum ada data pelanggan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
