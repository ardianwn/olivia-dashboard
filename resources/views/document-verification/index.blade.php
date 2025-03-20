<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Berkas yang Diupload
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="overflow-hidden border-b border-gray-200 p-6">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                        <thead class="bg-gray-100">
                            <tr class="border-b border-gray-200">
                                <th class="py-3 px-6 text-left text-gray-600 font-semibold">Nama Tim</th>
                                <th class="py-3 px-6 text-left text-gray-600 font-semibold">Berkas</th>
                                <th class="py-3 px-6 text-left text-gray-600 font-semibold">Status Verifikasi</th>
                                <th class="py-3 px-6 text-left text-gray-600 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($berkas as $item)
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                                    <td class="py-3 px-6 text-gray-800">{{ $item->tim->nama_tim }}</td>
                                    <td class="py-3 px-6">
                                        <a href="{{ asset('storage/' . $item->url_file) }}" target="_blank"
                                           class="text-blue-500 hover:text-blue-700 font-medium">
                                            📄 {{ $item->nama_file }}
                                        </a>
                                    </td>
                                    <td class="py-3 px-6 text-gray-800">
                                        <span class="px-3 py-1 text-white rounded-lg
                                            @if($item->status_verifikasi == 'pending') bg-yellow-500
                                            @elseif($item->status_verifikasi == 'valid') bg-green-500
                                            @else ($item->status_verifikasi == 'suspend') bg-red-500 @endif">
                                            {{ ucfirst($item->status_verifikasi) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <a 
                                           class="text-green-500 hover:text-green-600 font-medium mr-4">
                                            Terima
                                        </a>
                                        <a 
                                           class="text-red-500 hover:text-red-600 font-medium">
                                            Tolak
                                        </a>
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
