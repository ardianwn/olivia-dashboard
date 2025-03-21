<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Laporan Pendaftaran Lomba
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-3 px-6 text-left">Nama Tim</th>
                                <th class="py-3 px-6 text-left">Asal Kampus</th>
                                <th class="py-3 px-6 text-left">Kategori Lomba</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($timLomba as $tim)
                                <tr>
                                    <td class="py-3 px-6">{{ $tim->nama_tim }}</td>
                                    <td class="py-3 px-6">{{ $tim->nama_kampus }}</td>
                                    <td class="py-3 px-6">{{ $tim->kategori->nama_kategori}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        <form action="{{ route('report.export') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-700 hover:bg-green-600 font-medium mr-4 px-3 py-1 text-white rounded-lg">Unduh Excel </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
