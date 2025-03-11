<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Kategori Lomba: {{ $kategori->nama_kategori }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('competition-category.update', $kategori->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                            <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}" class="mt-1 block w-full p-2 border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="jumlah_anggota" class="block text-sm font-medium text-gray-700">Jumlah Anggota Maksimal</label>
                            <input type="number" name="jumlah_anggota" value="{{ $kategori->jumlah_anggota }}" class="mt-1 block w-full p-2 border-gray-300 rounded-md" required>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update Kategori</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
