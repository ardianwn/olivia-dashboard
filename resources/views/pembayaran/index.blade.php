<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bukti Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-500 text-white rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 p-4 bg-red-500 text-white rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Detail Bukti Pembayaran</h3>
                    @if ($pembayaran)
                        <a href="{{ route('pembayaran.create', $pembayaran->id) }}" 
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Upload Bukti Pembayaran
                        </a>
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2">No</th>
                                <th class="border border-gray-300 px-4 py-2">Status Verifikasi</th>
                                <th class="border border-gray-300 px-4 py-2">Bukti Pembayaran</th>
                                <th class="border border-gray-300 px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($pembayaran)
                                <tr class="text-center">
                                    <td class="border border-gray-300 px-4 py-2">1</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        @if ($pembayaran->status_verifikasi == 'pending')
                                            <span class="px-2 py-1 bg-yellow-500 text-white rounded">Pending</span>
                                        @elseif ($pembayaran->status_verifikasi == 'diterima')
                                            <span class="px-2 py-1 bg-green-500 text-white rounded">Diterima</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-500 text-white rounded">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="text-blue-600 hover:underline">
                                            Lihat Bukti
                                        </a>
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <a href="{{ route('pembayaran.edit', $pembayaran->id) }}" class="text-blue-500 hover:underline">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="4" class="text-center p-4 text-gray-500">
                                        Belum ada bukti pembayaran yang diunggah.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                @if (!$pembayaran)
                    <div class="text-center mt-4">
                        <a href="{{ route('pembayaran.create') }}" 
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Upload Bukti Pembayaran
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
