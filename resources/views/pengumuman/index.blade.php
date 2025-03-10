<x-admin-layout>
    <h1 class="text-xl font-bold mb-4">Daftar Pengumuman</h1>

    <!-- Button untuk membuat pengumuman baru -->
    <a href="{{ route('pengumuman.create') }}" class="btn btn-primary mb-4">Buat Pengumuman Baru</a>

    <!-- Menampilkan daftar pengumuman -->
    @foreach($pengumuman as $item)
        <div class="p-4 border mb-4">
            <h2 class="text-lg font-semibold">{{ $item->judul }}</h2>
            <p>{{ \Str::limit($item->isi, 100) }}</p>
            <a href="{{ route('pengumuman.edit', $item->id) }}" class="text-blue-600">Edit</a>

            <!-- Form untuk menghapus pengumuman -->
            <form action="{{ route('pengumuman.destroy', $item->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600">Hapus</button>
            </form>
        </div>
    @endforeach
</x-admin-layout>
