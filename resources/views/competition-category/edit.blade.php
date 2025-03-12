<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            Edit Kategori Lomba
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Form Edit Kategori</h3>

                <form action="{{ route('competition-category.update', $kategori->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                        <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}" class="mt-1 block w-full p-2 border-gray-300 rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label for="jumlah_anggota_maksimal" class="block text-sm font-medium text-gray-700">Jumlah Anggota Maksimal</label>
                        <input type="number" name="jumlah_anggota_maksimal" value="{{ $kategori->jumlah_anggota_maksimal }}" class="mt-1 block w-full p-2 border-gray-300 rounded-md" min="1" required>
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
