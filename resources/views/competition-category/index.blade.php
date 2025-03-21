<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            Kategori Lomba
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-700">Daftar Kategori</h3>
                        <a href="{{ route('competition-category.create') }}" 
                            class="bg-green-700 hover:bg-green-600 font-medium mr-4 px-3 py-1 text-white rounded-lg">
                            + Tambah Kategori
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                            <thead class="bg-gray-100">
                                <tr class="border-b border-gray-200">
                                    <th class="py-3 px-6 text-left text-gray-600 font-semibold">Nama Kategori</th>
                                    <th class="py-3 px-6 text-left text-gray-600 font-semibold">Jumlah Anggota Maksimal</th>
                                    <th class="py-3 px-6 text-left text-gray-600 font-semibold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategori as $item)
                                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                                        <td class="py-3 px-6 text-gray-800">{{ $item->nama_kategori }}</td>
                                        <td class="py-3 px-6 text-gray-800">{{ $item->jumlah_anggota_maksimal }}</td>
                                        <td class="py-3 px-6 text-center">
                                            <a href="{{ route('competition-category.edit', $item->id) }}" 
                                                class="bg-orange-400 hover:bg-orange-300 font-medium mr-4 px-3 py-1 text-white rounded-lg">
                                                Edit
                                            </a>
                                            <form action="{{ route('competition-category.destroy', $item->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <a type="submit" 
                                                    class="bg-red-700 hover:bg-red-600 font-medium mr-4 px-3 py-1 text-white rounded-lg cursor-pointer"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                    Hapus
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if(session('success'))
                        <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
