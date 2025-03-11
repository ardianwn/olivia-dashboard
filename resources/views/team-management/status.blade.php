<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Status Pendaftaran Tim: {{ $tim->nama_tim }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <p><strong>Status Verifikasi:</strong> {{ $tim->status_verifikasi }}</p>
                    <p><strong>Status Berkas:</strong> {{ $tim->berkas->first()->status_verifikasi ?? 'Belum Diupload' }}</p>
                    <p><strong>Status Pembayaran:</strong> {{ $tim->pembayaran->status_verifikasi ?? 'Belum Diupload' }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
