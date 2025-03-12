<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Kategori Lomba
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('competition-category.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                            <input type="text" name="nama_kategori" class="mt-1 block w-full p-2 border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="jumlah_anggota_maksimal" class="block text-sm font-medium text-gray-700">Jumlah Anggota Maksimal</label>
                            <input type="number" name="jumlah_anggota_maksimal" class="mt-1 block w-full p-2 border-gray-300 rounded-md" min="1" required>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
