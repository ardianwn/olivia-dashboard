<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kategori Lomba
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="overflow-hidden border-b border-gray-200">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-3 px-6 text-left">Nama Kategori</th>
                                <th class="py-3 px-6 text-left">Jumlah Anggota Maksimal</th>
                                <th class="py-3 px-6 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $item)
                                <tr>
                                    <td class="py-3 px-6">{{ $item->nama_kategori }}</td>
                                    <td class="py-3 px-6">{{ $item->jumlah_anggota }}</td>
                                    <td class="py-3 px-6">
                                        <a href="{{ route('competition-category.edit', $item->id) }}" class="text-yellow-500">Edit</a>
                                        <a href="{{ route('competition-category.destroy', $item->id) }}" class="text-red-500">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        <a href="{{ route('competition-category.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-md">Tambah Kategori Lomba</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
