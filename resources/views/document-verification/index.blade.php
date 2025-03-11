<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Berkas yang Diupload
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
                                <th class="py-3 px-6 text-left">Berkas</th>
                                <th class="py-3 px-6 text-left">Status Verifikasi</th>
                                <th class="py-3 px-6 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($berkas as $item)
                                <tr>
                                    <td class="py-3 px-6">{{ $item->tim->nama_tim }}</td>
                                    <td class="py-3 px-6">{{ $item->nama_file }}</td>
                                    <td class="py-3 px-6">{{ $item->status_verifikasi }}</td>
                                    <td class="py-3 px-6">
                                        <a href="{{ route('document-verification.show', $item->id) }}" class="text-blue-500">Lihat</a>
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
