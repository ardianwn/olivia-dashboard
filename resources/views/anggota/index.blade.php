<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Anggota Tim') }}
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
                    <h3 class="text-lg font-semibold">Anggota Tim: {{ $tim->nama_tim ?? 'Tidak Diketahui' }}</h3>
                    @if ($data <= 2)
                    <a href="{{ route('anggota.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                        + Tambah Anggota
                    </a>
                    @else
                    <a href="{{ route('pembayaran.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Lanjut
                    </a>
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2">No</th>
                                <th class="border border-gray-300 px-4 py-2">NIM</th>
                                <th class="border border-gray-300 px-4 py-2">Nama Lengkap</th>
                                <th class="border border-gray-300 px-4 py-2">No. WA</th>
                                <th class="border border-gray-300 px-4 py-2">Scan KTM</th>
                                <th class="border border-gray-300 px-4 py-2">Foto</th>
                                <th class="border border-gray-300 px-4 py-2">Status</th>
                                <th class="border border-gray-300 px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($anggota as $index => $member)
                                <tr class="text-center">
                                    <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $member->nim }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $member->nama_lengkap }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $member->no_wa }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        @if ($member->scan_ktm)
                                            <a href="{{ asset('storage/' . $member->scan_ktm) }}" target="_blank" class="text-blue-600 hover:underline">
                                                Lihat KTM
                                            </a>
                                        @else
                                            <span class="text-gray-500">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        @if ($member->foto_anggota)
                                            <img src="{{ asset('storage/' . $member->foto_anggota) }}" alt="Foto" class="w-12 h-12 rounded-full mx-auto">
                                        @else
                                            <span class="text-gray-500">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        @if ($member->status_verifikasi == 'pending')
                                            <span class="px-2 py-1 bg-yellow-500 text-white rounded">Pending</span>
                                        @elseif ($member->status_verifikasi == 'verified')
                                            <span class="px-2 py-1 bg-green-500 text-white rounded">Verified</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-500 text-white rounded">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <a href="{{ route('anggota.edit', $member->id) }}" class="text-blue-500 hover:underline">Edit</a> | 
                                        <form action="{{ route('anggota.destroy', $member->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Yakin ingin menghapus anggota ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center p-4 text-gray-500">Belum ada anggota dalam tim.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
