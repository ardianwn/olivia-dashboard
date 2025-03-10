<x-admin-layout>
    <h1 class="text-xl font-bold mb-4">Buat Pengumuman Baru</h1>

    <!-- Form untuk membuat pengumuman -->
    <form action="{{ route('pengumuman.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <x-input-label for="judul" :value="__('Judul Pengumuman')" />
            <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" value="{{ old('judul') }}" required autofocus />
            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="jenis" :value="__('Jenis Pengumuman')" />
            <x-text-input id="jenis" class="block mt-1 w-full" type="text" name="jenis" value="{{ old('jenis') }}" required />
            <x-input-error :messages="$errors->get('jenis')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="isi" :value="__('Isi Pengumuman')" />
            <x-textarea id="isi" class="block mt-1 w-full" name="isi" required>{{ old('isi') }}</x-textarea>
            <x-input-error :messages="$errors->get('isi')" class="mt-2" />
        </div>

        <x-primary-button>{{ __('Buat Pengumuman') }}</x-primary-button>
    </form>
</x-admin-layout>
