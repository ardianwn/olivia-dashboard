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
            <td class="text-lg font-semibold mb-4">Cabang Lomba: {{ $tim->cabang_lomba }}</td> <br>
            <td class="border border-gray-300 px-4 py-2">Foto Tim: 
                @if ($tim->foto_tim)
                    <img src="{{ asset('storage/' . $tim->foto_tim) }}" alt="Foto Tim" class="w-16 h-16 object-cover rounded">
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
                                        <a href="{{ asset('storage/' . $member->scan_ktm) }}" target="_blank" class="text-blue-600 hover:underline">Lihat</a>
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
                <h4 class="text-md font-semibold">Berkas Lomba</h4>
                <table class="w-full border-collapse border border-gray-300 mt-2">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border px-4 py-2">Nama File</th>
                            <th class="border px-4 py-2">File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($berkas as $file)
                            <tr class="text-center">
                                <td class="border px-4 py-2">{{ $file->nama_file }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ asset('storage/' . $file->url_file) }}" target="_blank" class="text-blue-600 hover:underline">Lihat</a>
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

            @if (!$tim->final_submit)
                <form action="{{ route('final.submit') }}" method="POST" onsubmit="return confirm('Setelah final submit, data tidak bisa diubah lagi. Lanjutkan?')">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Final Submit</button>
                </form>
            @else
                <p class="text-lg text-green-600 font-bold">Sudah Final Submit. Tidak dapat mengubah data.</p>
            @endif

        </div>
    </div>
</x-app-layout>
