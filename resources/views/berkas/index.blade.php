<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Berkas Lomba') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-semibold">Berkas: {{ $tim->nama_tim ?? 'Tidak Diketahui' }}</h3>
                    <a href="{{ route('berkas.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                        + Upload Berkas
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2">No</th>
                                <th class="border border-gray-300 px-4 py-2">Nama Berkas</th>
                                <th class="border border-gray-300 px-4 py-2">File</th>
                                <th class="border border-gray-300 px-4 py-2">Status</th>
                                <th class="border border-gray-300 px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($berkas as $index => $b)
                                <tr class="text-center">
                                    <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $b->nama_file }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <a href="{{ asset('storage/' . $b->url_file) }}" target="_blank" class="text-blue-600 hover:underline">
                                            Download
                                        </a>
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        @if ($b->status_verifikasi == 'pending')
                                            <span class="px-2 py-1 bg-yellow-500 text-white rounded">Pending</span>
                                        @elseif ($b->status_verifikasi == 'diterima')
                                            <span class="px-2 py-1 bg-green-500 text-white rounded">Diterima</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-500 text-white rounded">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <form action="{{ route('berkas.destroy', $b->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Yakin ingin menghapus berkas ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center p-4 text-gray-500">Belum ada berkas yang diunggah.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
