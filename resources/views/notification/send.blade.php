<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kirim Notifikasi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('notification.sendNotification') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="message" class="block text-sm font-medium text-gray-700">Pesan Notifikasi</label>
                            <textarea name="message" class="mt-1 block w-full p-2 border-gray-300 rounded-md" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Kirim Notifikasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
