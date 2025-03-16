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
                    @if (!$data)
                    <a href="{{ route('berkas.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                        + Upload Berkas
                    </a>
                    @endif
                    @foreach ($berkas as $b)
                    @if ($b->status_verifikasi == 'reject')
                    <a href="{{ route('berkas.edit', $b->id) }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">
                        Perbaiki Berkas
                    </a>
                    @elseif ($b->status_verifikasi == 'valid')
                    <a href="{{ route('berkas.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Lanjut
                    </a>
                    @endif
                    @endforeach
                </div>


                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2">No</th>
                                <th class="border border-gray-300 px-4 py-2">Lembar Pengesahan</th>
                                <th class="border border-gray-300 px-4 py-2">Pernyataan Orisinalitas</th>
                                <th class="border border-gray-300 px-4 py-2">Biodata</th>
                                <th class="border border-gray-300 px-4 py-2">Formulir Pendaftaran</th>
                                <th class="border border-gray-300 px-4 py-2">Karya</th>
                                <th class="border border-gray-300 px-4 py-2">Status</th>
                                <th class="border border-gray-300 px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp

                            @forelse ($berkas as $index => $b)
                            <tr class="text-center">
                                <td class="border border-gray-300 px-4 py-2">{{ $no++ }}</td>

                                <!-- Pastikan file ada sebelum menampilkan link download -->
                                <td class="border border-gray-300 px-4 py-2">
                                    @if ($b->pengesahan)
                                    <a href="{{ asset('storage/' . $b->pengesahan) }}" target="_blank" class="text-blue-600 hover:underline">
                                        Download
                                    </a>
                                    @else
                                    <span class="text-gray-500">Tidak tersedia</span>
                                    @endif
                                </td>

                                <td class="border border-gray-300 px-4 py-2">
                                    @if ($b->orisinalitas)
                                    <a href="{{ asset('storage/' . $b->orisinalitas) }}" target="_blank" class="text-blue-600 hover:underline">
                                        Download
                                    </a>
                                    @else
                                    <span class="text-gray-500">Tidak tersedia</span>
                                    @endif
                                </td>

                                <td class="border border-gray-300 px-4 py-2">
                                    @if ($b->biodata)
                                    <a href="{{ asset('storage/' . $b->biodata) }}" target="_blank" class="text-blue-600 hover:underline">
                                        Download
                                    </a>
                                    @else
                                    <span class="text-gray-500">Tidak tersedia</span>
                                    @endif
                                </td>

                                <td class="border border-gray-300 px-4 py-2">
                                    @if ($b->form_pendaftaran)
                                    <a href="{{ asset('storage/' . $b->form_pendaftaran) }}" target="_blank" class="text-blue-600 hover:underline">
                                        Download
                                    </a>
                                    @else
                                    <span class="text-gray-500">Tidak tersedia</span>
                                    @endif
                                </td>

                                <td class="border border-gray-300 px-4 py-2">
                                    @if ($b->url_file)
                                    <a href="{{ $b->url_file }}" target="_blank" class="text-blue-600 hover:underline">
                                        Lihat Karya
                                    </a>
                                    @else
                                    <span class="text-gray-500">Tidak tersedia</span>
                                    @endif
                                </td>

                                <!-- Status Verifikasi -->
                                <td class="border border-gray-300 px-4 py-2">
                                    @if ($b->status_verifikasi == 'pending')
                                    <span class="px-2 py-1 bg-yellow-500 text-white rounded">Pending</span>
                                    @elseif ($b->status_verifikasi == 'valid')
                                    <span class="px-2 py-1 bg-green-500 text-white rounded">Diterima</span>
                                    @else
                                    <span class="px-2 py-1 bg-red-500 text-white rounded">Ditolak</span>
                                    @endif
                                </td>

                                <!-- Aksi -->
                                <td class="border border-gray-300 px-4 py-2">
                                    @if ($b->status_verifikasi == 'rejected')
                                    <a href="{{ route('berkas.edit', $b->id) }}" class="text-blue-500 hover:underline">
                                        Edit
                                    </a>
                                    @elseif ($b->status_verifikasi == 'pending')
                                    <span class="text-gray-500">Menunggu Verifikasi Admin</span>
                                    @elseif ($b->status_verifikasi == 'valid')
                                    <a href="{{ route('berkas.index') }}" class="text-blue-500 hover:underline">
                                        Lanjutkan Pengisian Berkas
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center p-4 text-gray-500">Belum ada berkas yang diunggah.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>