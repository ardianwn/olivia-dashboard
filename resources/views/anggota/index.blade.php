<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Anggota Tim') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($anggota as $index => $member)
                    <div class="bg-gray-100 shadow-md rounded-lg p-4 text-center">
                        <!-- Foto Anggota -->
                        @if ($member->foto_anggota)
                        <img src="{{ asset('storage/' . $member->foto_anggota) }}" alt="Foto Anggota" class="w-24 h-24 rounded-full mx-auto border-4 border-red-500">
                        @else
                        <img src="{{ asset('images/default-profile.png') }}" alt="Default Foto" class="w-24 h-24 rounded-full mx-auto border-4 border-red-500">
                        @endif

                        <!-- Role Anggota -->
                        <h3 class="mt-3 text-lg font-semibold text-gray-800">
                            @if ($index == 0)
                            Leader
                            @else
                            Member {{ $no++ }}
                            @endif
                        </h3>

                        <!-- Nama Anggota -->
                        <p class="text-gray-600">{{ $member->nama_lengkap }}</p>
                        <p class="text-sm text-gray-500">{{ $member->tim->nama_tim ?? 'Tidak ada tim' }}</p>

                        <!-- Tombol Aksi -->
                        <div class="mt-4 flex justify-center gap-2">
                            @if ($member->scan_ktm)
                            <a href="{{ asset('storage/' . $member->scan_ktm) }}" target="_blank"
                                class="bg-black text-white px-3 py-1 rounded-md hover:bg-gray-700">
                                Lihat KTM
                            </a>
                            @endif

                            <a href="{{ route('anggota.edit', $member->id) }}"
                                class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-700">
                                Edit
                            </a>

                            <form action="{{ route('anggota.destroy', $member->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-700"
                                    onclick="return confirm('Yakin ingin menghapus anggota ini?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach

                    <!-- Kotak Kosong untuk Tambah Anggota -->
                    @if (count($anggota) < 3)
                        <div class="bg-gray-100 shadow-md rounded-lg p-4 text-center">
                        <!-- Foto Anggota -->
                        <img src="{{ asset('storage/anggota/image.png' ) }}" alt="Foto Anggota" class="w-24 h-24 rounded-full mx-auto border-4 border-red-500">


                        <!-- Role Anggota -->
                        <h3 class="mt-3 text-lg font-semibold text-gray-800">
                            @if ($index == 0)
                            Leader
                            @else
                            Member {{ $no++ }}
                            @endif
                        </h3>

                        <!-- Nama Anggota -->
                        <p class="text-gray-600">Tambah Anggota</p>


                        <!-- Tombol Aksi -->
                        <div class="mt-4 flex justify-center gap-2">
                            <a href="{{ route('anggota.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-700">
                                + Tambah Anggota
                            </a>
                        </div>
                </div>
                <!-- <div class="bg-gray-100 shadow-md rounded-lg p-6 flex flex-col justify-center items-center text-center border-2 border-dashed border-gray-300">
                            <p class="text-gray-600 mb-2">Tambah Anggota</p>
                            <a href="{{ route('anggota.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-700">
                                + Tambah Anggota
                            </a>
                        </div> -->
                @endif
            </div>

        </div>
    </div>
    </div>
</x-app-layout>