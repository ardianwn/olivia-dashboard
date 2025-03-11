<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tolak Pembayaran
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <p><strong>Nama Tim:</strong> {{ $pembayaran->tim->nama_tim }}</p>
                    <p><strong>Bukti Pembayaran:</strong> <a href="{{ $pembayaran->bukti_pembayaran }}" target="_blank" class="text-blue-500">Lihat Bukti</a></p>
                    <form method="POST" action="{{ route('payment-management.reject', $pembayaran->id) }}">
                        @csrf
                        <textarea name="alasan" placeholder="Alasan Penolakan" rows="4" class="border-gray-300 border p-2 w-full"></textarea>
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md mt-2">Tolak Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
