<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Berkas Lomba</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <form action="{{ route('berkas.update', $berkas->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 shadow rounded">
            @csrf
            @method('PUT')

            <!-- Lembar Pengesahan -->
            <label>Lembar Pengesahan</label>
            @if ($berkas->pengesahan)
            <p class="text-sm text-gray-500">
                File saat ini: <a href="{{ asset('storage/' . $berkas->pengesahan) }}" target="_blank" class="text-blue-500 underline">Lihat</a>
            </p>
            @endif
            <input type="file" name="pengesahan" class="w-full border p-2 rounded">

            <!-- Pernyataan Orisinalitas -->
            <label>Pernyataan Orisinalitas</label>
            @if ($berkas->orisinalitas)
            <p class="text-sm text-gray-500">
                File saat ini: <a href="{{ asset('storage/' . $berkas->orisinalitas) }}" target="_blank" class="text-blue-500 underline">Lihat</a>
            </p>
            @endif
            <input type="file" name="orisinalitas" class="w-full border p-2 rounded">

            <!-- Biodata Peserta & Pembimbing -->
            <label>Biodata Peserta & Pembimbing</label>
            @if ($berkas->biodata)
            <p class="text-sm text-gray-500">
                File saat ini: <a href="{{ asset('storage/' . $berkas->biodata) }}" target="_blank" class="text-blue-500 underline">Lihat</a>
            </p>
            @endif
            <input type="file" name="biodata" class="w-full border p-2 rounded">

            <!-- Formulir Pendaftaran -->
            <label>Formulir Pendaftaran</label>
            @if ($berkas->form_pendaftaran)
            <p class="text-sm text-gray-500">
                File saat ini: <a href="{{ asset('storage/' . $berkas->form_pendaftaran) }}" target="_blank" class="text-blue-500 underline">Lihat</a>
            </p>
            @endif
            <input type="file" name="form_pendaftaran" class="w-full border p-2 rounded">

            <!-- Link Drive Karya -->
            <label>Link Drive Karya</label>
            <input type="text" name="url_file" value="{{ old('url_file', $berkas->url_file) }}" class="w-full border p-2 rounded">

            <!-- Status Verifikasi (Otomatis Jadi Pending) -->
            <input type="hidden" name="status_verifikasi" value="pending">
            
            <!-- Tombol Update -->
            <x-primary-button>Update</x-primary-button>
        </form>

    </div>
</x-app-layout>