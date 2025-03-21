<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Preview & Final Submit</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
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
            <h3 class="text-lg font-semibold mb-2">Data Tim: {{ $tim->nama_tim }}</h3>
            <td class="text-lg font-semibold mb-4">Asal Kampus: {{ $tim->nama_kampus }}</td> <br>
            <td class="text-lg font-semibold mb-4">Cabang Lomba: {{ $tim->kategori->nama_kategori }}</td> <br>
            <td class="border border-gray-300 px-4 py-2">Foto Tim:
                @if ($tim->foto_tim)
                    <img src="{{ asset('storage/' . $tim->foto_tim) }}" alt="Foto Tim"
                        class="w-16 h-16 object-cover rounded">
                @else
                    <span class="text-gray-500">Tidak ada foto</span>
                @endif
            </td>

            <div class="mt-6 mb-6">
                <h4 class="text-md font-semibold">Anggota Tim</h4>
                <table class="w-full border-collapse border border-gray-300 mt-2">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border px-4 py-2">Nama</th>
                            <th class="border px-4 py-2">NIM</th>
                            <th class="border px-4 py-2">No WA</th>
                            <th class="border px-4 py-2">Scan KTM</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggota as $member)
                            <tr class="text-center">
                                <td class="border px-4 py-2">{{ $member->nama_lengkap }}</td>
                                <td class="border px-4 py-2">{{ $member->nim }}</td>
                                <td class="border px-4 py-2">{{ $member->no_wa }}</td>
                                <td class="border px-4 py-2">
                                    @if ($member->scan_ktm)
                                        <a href="{{ asset('storage/' . $member->scan_ktm) }}" target="_blank"
                                            class="text-blue-600 hover:underline">Lihat</a>
                                    @else
                                        <span class="text-red-500">Belum Upload</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mb-6">
                <h4 class="text-md font-semibold">Bukti Pembayaran</h4>
                @if ($pembayaran)
                    <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" class="w-48 h-auto mt-2">
                @else
                    <span class="text-red-500">Belum Upload</span>
                @endif
            </div>

            <div class="overflow-x-auto mb-6">
                <h4 class="text-md mb-2 font-semibold">Bukti Pembayaran</h4>
                    <table class="w-full table-auto border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2">No</th>
                                <th class="border border-gray-300 px-4 py-2">Lembar Pengesahan</th>
                                <th class="border border-gray-300 px-4 py-2">Pernyataan Orisinalitas</th>
                                <th class="border border-gray-300 px-4 py-2">Biodata</th>
                                <th class="border border-gray-300 px-4 py-2">Formulir Pendaftaran</th>
                                <th class="border border-gray-300 px-4 py-2">Karya</th>
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
                                        Lihat
                                    </a>
                                    @else
                                    <span class="text-gray-500">Tidak tersedia</span>
                                    @endif
                                </td>

                                <td class="border border-gray-300 px-4 py-2">
                                    @if ($b->orisinalitas)
                                    <a href="{{ asset('storage/' . $b->orisinalitas) }}" target="_blank" class="text-blue-600 hover:underline">
                                        Lihat
                                    </a>
                                    @else
                                    <span class="text-gray-500">Tidak tersedia</span>
                                    @endif
                                </td>

                                <td class="border border-gray-300 px-4 py-2">
                                    @if ($b->biodata)
                                    <a href="{{ asset('storage/' . $b->biodata) }}" target="_blank" class="text-blue-600 hover:underline">
                                        Lihat
                                    </a>
                                    @else
                                    <span class="text-gray-500">Tidak tersedia</span>
                                    @endif
                                </td>

                                <td class="border border-gray-300 px-4 py-2">
                                    @if ($b->form_pendaftaran)
                                    <a href="{{ asset('storage/' . $b->form_pendaftaran) }}" target="_blank" class="text-blue-600 hover:underline">
                                        Lihat
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
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center p-4 text-gray-500">Belum ada berkas yang diunggah.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>


            @if ($tim->status_final_submit == 0)
                    <form action="{{ route('final.submit') }}" method="POST"
                        onsubmit="return confirm('Setelah final submit, data tidak bisa diubah lagi. Lanjutkan?')">
                        @csrf
                        <button type="submit" class="bg-green-700 hover:bg-green-600 font-medium mr-4 px-3 py-1 text-white rounded-lg">Final Submit</button>
                    </form>
            @else
                <p class="text-lg text-green-600 font-bold">Sudah Final Submit. Tidak dapat mengubah data.</p>
            @endif

        </div>
    </div>
</x-app-layout>
