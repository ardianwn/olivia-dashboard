<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Bukti Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if (session('error'))
                    <div class="mb-4 p-4 bg-red-500 text-white rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('pembayaran.update', $pembayaran->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Bukti Pembayaran Saat Ini</label>
                        <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="mt-2 w-64 h-auto rounded shadow">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Upload Bukti Pembayaran Baru (JPG/PNG, max 2MB)</label>
                        <input type="file" name="bukti_pembayaran" class="w-full border p-2 rounded mt-2">
                    </div>

                    <x-primary-button>
                        Update Bukti Pembayaran
                    </x-primary-button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
