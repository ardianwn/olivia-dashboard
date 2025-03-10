<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Berkas Lomba</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <form action="{{ route('berkas.update', $berkas->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 shadow rounded">
            @csrf @method('PUT')

            <label>Nama File</label>
            <input type="text" name="name_file" value="{{ $berkas->nama_file }}" required class="w-full border p-2 rounded">

            <label>Berkas</label>
            <input type="file" name="url_file" class="w-full border p-2 rounded">

            <button type="submit" class="mt-4 px-4 py-2 bg-yellow-600 text-white rounded">Update</button>
        </form>
    </div>
</x-app-layout>
