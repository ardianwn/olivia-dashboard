<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Verifikasi Pembayaran
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <p><strong>Nama Tim:</strong> {{ $pembayaran->tim->nama_tim }}</p>
                    <p><strong>Bukti Pembayaran:</strong> <a href="{{ $pembayaran->bukti_pembayaran }}" target="_blank" class="text-blue-500">Lihat Bukti</a></p>
                    <form method="POST" action="{{ route('payment-management.verify', $pembayaran->id) }}">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Verifikasi Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
