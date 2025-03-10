<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Berkas Lomba') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-500 text-white rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('berkas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Nama Berkas</label>
                        <input type="text" name="nama_file" class="w-full border-gray-300 rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Upload Berkas (PDF/DOC/DOCX)</label>
                        <input type="file" name="url_file" class="w-full border-gray-300 rounded p-2" required>
                    </div>

                    <x-primary-button>Upload</x-primary-button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
