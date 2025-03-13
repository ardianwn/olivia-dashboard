<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tim') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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

                <form action="{{ route('tim.update', $tim->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-4">
                        <label class="block font-semibold">Nama Tim</label>
                        <input type="text" name="nama_tim" value="{{ $tim->nama_tim }}" required class="w-full border p-2 rounded focus:ring focus:ring-blue-200">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold">Nama Kampus</label>
                        <input type="text" name="nama_kampus" value="{{ $tim->nama_kampus }}" required class="w-full border p-2 rounded focus:ring focus:ring-blue-200">
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold">Cabang Lomba</label>
                        <select name="cabang_lomba" required
                            class="w-full border p-2 rounded focus:ring focus:ring-blue-200">
                            <option value="" disabled selected>Pilih Cabang Lomba</option>
                            @foreach ($kategoriLomba as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-yellow-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-700 transition">
                        Update Tim
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
