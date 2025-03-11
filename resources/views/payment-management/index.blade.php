<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Pembayaran yang Diupload
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="overflow-hidden border-b border-gray-200">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-3 px-6 text-left">Nama Tim</th>
                                <th class="py-3 px-6 text-left">Bukti Pembayaran</th>
                                <th class="py-3 px-6 text-left">Status Verifikasi</th>
                                <th class="py-3 px-6 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembayaran as $item)
                                <tr>
                                    <td class="py-3 px-6">{{ $item->tim->nama_tim }}</td>
                                    <td class="py-3 px-6">{{ $item->bukti_pembayaran }}</td>
                                    <td class="py-3 px-6">{{ $item->status_verifikasi }}</td>
                                    <td class="py-3 px-6">
                                        <a href="{{ route('payment-management.verify', $item->id) }}" class="text-green-500">Verifikasi</a>
                                        <a href="{{ route('payment-management.reject', $item->id) }}" class="text-red-500">Tolak</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
