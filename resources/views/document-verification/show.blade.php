<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Berkas Tim: {{ $berkas->tim->nama_tim }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <p><strong>Nama Berkas:</strong> {{ $berkas->nama_file }}</p>
                    <p><strong>URL File:</strong> <a href="{{ $berkas->url_file }}" target="_blank" class="text-blue-500">Lihat Berkas</a></p>
                    <p><strong>Status Verifikasi:</strong> {{ $berkas->status_verifikasi }}</p>
                    <form method="POST" action="{{ route('document-verification.approve', $berkas->id) }}">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Setujui Berkas</button>
                    </form>
                    <form method="POST" action="{{ route('document-verification.reject', $berkas->id) }}" class="mt-4">
                        @csrf
                        <textarea name="catatan" placeholder="Catatan Revisi" rows="4" class="border-gray-300 border p-2 w-full"></textarea>
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md mt-2">Tolak Berkas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
