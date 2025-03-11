<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Tim: {{ $tim->nama_tim }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('team-management.update', $tim->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="nama_tim" class="block text-sm font-medium text-gray-700">Nama Tim</label>
                            <input type="text" name="nama_tim" value="{{ $tim->nama_tim }}" class="mt-1 block w-full p-2 border-gray-300 rounded-md">
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Perbarui Tim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
