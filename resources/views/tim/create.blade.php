<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Tim Baru') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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

                <form action="{{ route('tim.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-semibold">Nama Tim</label>
                        <input type="text" name="nama_tim" required class="w-full border p-2 rounded focus:ring focus:ring-blue-200">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold">Nama Kampus</label>
                        <input type="text" name="nama_kampus" required class="w-full border p-2 rounded focus:ring focus:ring-blue-200">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold">Cabang Lomba</label>
                        <input type="text" name="cabang_lomba" required class="w-full border p-2 rounded focus:ring focus:ring-blue-200">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold">Foto Tim</label>
                        <input type="file" name="foto_tim" required class="w-full border p-2 rounded focus:ring focus:ring-blue-200">
                    </div>
                    <x-primary-button>Create</x-primary-button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
