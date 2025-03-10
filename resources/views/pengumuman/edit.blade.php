<x-admin-layout>
    <h1 class="text-xl font-bold mb-4">Edit Pengumuman</h1>

    <!-- Form untuk mengedit pengumuman -->
    <form action="{{ route('pengumuman.update', $pengumuman->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <x-input-label for="judul" :value="__('Judul Pengumuman')" />
            <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" value="{{ $pengumuman->judul }}" required />
            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="jenis" :value="__('Jenis Pengumuman')" />
            <x-text-input id="jenis" class="block mt-1 w-full" type="text" name="jenis" value="{{ $pengumuman->jenis }}" required />
            <x-input-error :messages="$errors->get('jenis')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="isi" :value="__('Isi Pengumuman')" />
            <x-textarea id="isi" class="block mt-1 w-full" name="isi" required>{{ $pengumuman->isi }}</x-textarea>
            <x-input-error :messages="$errors->get('isi')" class="mt-2" />
        </div>

        <x-primary-button>{{ __('Simpan Pengumuman') }}</x-primary-button>
    </form>
</x-admin-layout>
