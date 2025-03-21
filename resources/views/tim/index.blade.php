
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Tim') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                @if (session('success'))
                <div id="success-message" class="mb-4 p-4 bg-green-500 text-white rounded">
                    {{ session('success') }}
                </div>
            @endif
            
            @if (session('error'))
                <div id="error-message" class="mb-4 p-4 bg-red-500 text-white rounded">
                    {{ session('error') }}
                </div>
            @endif
        
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Tim yang Terdaftar</h3>
                    @if (Auth::user()->tim === null)
                        <a href="{{ route('tim.create') }}" class="bg-blue-700 hover:bg-blue-600 font-medium mr-4 px-3 py-1 text-white rounded-lg">
                            + Buat Tim
                        </a>
                    @else
                    <a href="{{ route('anggota.index') }}" class="bg-blue-700 hover:bg-blue-600 font-medium mr-4 px-3 py-1 text-white rounded-lg">
                        Lanjut
                    </a>
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2">Foto</th>
                                <th class="border border-gray-300 px-4 py-2">Nama Tim</th>
                                <th class="border border-gray-300 px-4 py-2">Nama Kampus</th>
                                <th class="border border-gray-300 px-4 py-2">Cabang Lomba</th>
                                <th class="border border-gray-300 px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tim as $t)
                                <tr class="text-center">
                                    <td class="border border-gray-300 px-4 py-2">
                                        @if ($t->foto_tim)
                                            <img src="{{ asset('storage/' . $t->foto_tim) }}" alt="Foto Tim" class="w-16 h-16 object-cover rounded">
                                        @else
                                            <span class="text-gray-500">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $t->nama_tim }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $t->nama_kampus }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $t->kategori->nama_kategori }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <div class="flex justify-center space-x-2">
                                            @if ($t->id_ketua === auth()->id()) 
                                                <a href="{{ route('tim.edit', $t->id) }}" class="bg-orange-500 hover:bg-orange-400 font-medium mr-4 px-3 py-1 text-white rounded-lg">
                                                    Edit 
                                                </a> 
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center p-4 text-gray-500">Belum ada tim yang terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <script>
        // Hilangkan pesan flash setelah 10 detik
        setTimeout(function() {
            document.getElementById('success-message')?.remove();
            document.getElementById('error-message')?.remove();
        }, 5000); // 10,000 ms = 10 detik
    </script>
</x-app-layout>
