<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (Auth::user()->status == "active")
                    <div class="grid grid-cols-3 gap-6">
                            @foreach ($anggota as $key => $member)
                                <div class="bg-gray-100 p-6 rounded-lg text-center">
                                    <div class="w-32 h-32 mx-auto mb-4">
                                        <!-- Display Profile Picture -->
                                        <img src="{{ asset('storage/' . $member->profile ?? 'default.png') }}" alt="Profile Picture"
                                             class="w-full h-full object-cover rounded-full border border-gray-300">
                                    </div>
                                    <h3 class="font-semibold text-lg">{{ $key == 0 ? 'Leader' : 'Member ' . $key }}</h3>
                                    <p class="text-gray-600">{{ $member->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $member->program_study }}</p>

                                    <div class="mt-4 space-x-2">
                                        <!-- Actions -->
                                        <a href="{{ route('show.ktm', $member->id) }}" class="inline-block bg-black text-white px-4 py-2 rounded-md">Lihat KTM</a>
                                        <a href="{{ route('member.edit', $member->id) }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md">Edit</a>
                                        <a href="{{ route('member.delete', $member->id) }}" class="inline-block bg-red-500 text-white px-4 py-2 rounded-md">Delete</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Form for Editing Member Data -->
                        <form method="post" action="{{ route('pass.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            @method('put')
                            <div>
                                <x-input-label for="nama_lengkap" value="Nama Lengkap" />
                                <x-text-input type="text" class="mt-1 block w-full" placeholder="{{ Auth::user()->name }}" readonly />
                            </div>
                            <br>
                            <!-- NIM -->
                            <div class="mb-4">
                                <x-input-label for="nim" value="NIM" />
                                <x-text-input id="nim" class="block mt-1 w-full" type="text" name="nim" value="{{ old('nim', Auth::user()->nim) }}" required autofocus />
                                <x-input-error :messages="$errors->get('nim')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input type="text" class="mt-1 block w-full" placeholder="{{ Auth::user()->email }}" readonly />
                            </div>
                            <!-- No WA -->
                            <div class="mb-4">
                                <x-input-label for="no_wa" value="Nomor WhatsApp" />
                                <x-text-input id="no_wa" class="block mt-1 w-full" type="text" name="no_wa" value="{{ old('no_wa', Auth::user()->no_wa) }}" required />
                                <x-input-error :messages="$errors->get('no_wa')" class="mt-2" />
                            </div>
                            <div class="flex justify-end">
                                <x-primary-button>Simpan</x-primary-button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
