<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Tim: {{ $tim->nama_tim }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <p><strong>Ketua Tim:</strong> {{ $tim->anggota->first()->nama_lengkap }}</p>
                    <p><strong>Anggota Tim:</strong></p>
                    <ul>
                        @foreach ($tim->anggota as $anggota)
                            <li>{{ $anggota->nama_lengkap }} (NIM: {{ $anggota->nim }})</li>
                        @endforeach
                    </ul>
                    <p><strong>Kategori Lomba:</strong> {{ $tim->cabang_lomba }}</p>
                    <p><strong>Status Verifikasi:</strong> {{ $tim->status_verifikasi }}</p>
                    <p><strong>Status Submit:</strong> {{ $tim->status_final_submit }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
