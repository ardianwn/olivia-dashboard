<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Anggota: {{ $anggota->nama_lengkap }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form method="POST" action="{{ route('anggota.update', $anggota->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- NIM -->
                    <div class="mb-4">
                        <x-input-label for="nim" value="NIM" />
                        <x-text-input id="nim" class="block mt-1 w-full" type="text" name="nim" value="{{ old('nim', $anggota->nim) }}" required />
                        <x-input-error :messages="$errors->get('nim')" class="mt-2" />
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="mb-4">
                        <x-input-label for="nama_lengkap" value="Nama Lengkap" />
                        <x-text-input id="nama_lengkap" class="block mt-1 w-full" type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $anggota->nama_lengkap) }}" required />
                        <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-2" />
                    </div>

                    <!-- No WA -->
                    <div class="mb-4">
                        <x-input-label for="no_wa" value="Nomor WhatsApp" />
                        <x-text-input id="no_wa" class="block mt-1 w-full" type="text" name="no_wa" value="{{ old('no_wa', $anggota->no_wa) }}" required />
                        <x-input-error :messages="$errors->get('no_wa')" class="mt-2" />
                    </div>

                    <!-- Scan KTM -->
                    <div class="mb-4">
                        <x-input-label for="scan_ktm" value="Scan KTM (Biarkan kosong jika tidak ingin mengganti)" />
                        <x-text-input id="scan_ktm" class="block mt-1 w-full" type="file" name="scan_ktm" />
                        <x-input-error :messages="$errors->get('scan_ktm')" class="mt-2" />
                        <img src="{{ asset('storage/' . $anggota->scan_ktm) }}" alt="Scan KTM" class="mt-2 w-32">
                    </div>

                    <!-- Foto Anggota -->
                    <div class="mb-4">
                        <x-input-label for="foto_anggota" value="Foto Anggota (Biarkan kosong jika tidak ingin mengganti)" />
                        <x-text-input id="foto_anggota" class="block mt-1 w-full" type="file" name="foto_anggota" />
                        <x-input-error :messages="$errors->get('foto_anggota')" class="mt-2" />
                        <img src="{{ asset('storage/' . $anggota->foto_anggota) }}" alt="Foto Anggota" class="mt-2 w-32">
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>Simpan Perubahan</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
