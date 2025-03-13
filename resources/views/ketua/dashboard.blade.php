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
                    @if (Auth::user()->status == 'active')
                        @if (!$tim)
                            Anda sudah mengisi data pribadi anda. Silakan melanjutkan ketahab selanjutnya, <a
                                href="{{ route('tim.index') }}">klik disini</a>
                        @else
                            @php
                                $no = 1;
                            @endphp
                            <div class="grid grid-cols-3 gap-6">
                                @foreach ($anggota as $key => $member)
                                    <div class="bg-gray-100 shadow-md rounded-lg p-4 text-center">
                                        <!-- Foto Anggota -->
                                        @if ($member->foto_anggota)
                                            <img src="{{ asset('storage/' . $member->foto_anggota) }}" alt="Foto Anggota"
                                                class="w-24 h-24 rounded-full mx-auto border-4 border-red-500">
                                        @else
                                            <img src="{{ asset('images/default-profile.png') }}" alt="Default Foto"
                                                class="w-24 h-24 rounded-full mx-auto border-4 border-red-500">
                                        @endif

                                        <!-- Role Anggota -->
                                        <h3 class="mt-3 text-lg font-semibold text-gray-800">
                                            @if ($key == 0)
                                                Leader
                                            @else
                                                Member {{ $no++ }}
                                            @endif
                                        </h3>

                                        <!-- Nama Anggota -->
                                        <p class="text-gray-600">{{ $member->nama_lengkap }}</p>
                                        <p class="text-sm text-gray-500">{{ $member->nim ?? 'Tidak ada tim' }}</p>

                                        <!-- Tombol Aksi -->
                                        <div class="mt-4 flex justify-center gap-2">
                                            @if ($member->scan_ktm)
                                                <a href="{{ asset('storage/' . $member->scan_ktm) }}" target="_blank"
                                                    class="bg-black text-white px-3 py-1 rounded-md hover:bg-gray-700">
                                                    Lihat KTM
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <form method="post" action="{{ route('pass.update') }}" enctype="multipart/form-data"
                            class="mt-6 space-y-6">
                            @csrf
                            @method('put')
                            <div>
                                <x-input-label for="nama_lengkap" value="Nama Lengkap" />
                                <x-text-input type="text" class="mt-1 block w-full " name="name"
                                    value="{{ old('name', Auth::user()->name) }}" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />

                            </div>

                            <!-- NIM -->
                            <div class="mb-4">
                                <x-input-label for="nim" value="NIM" />
                                <x-text-input id="nim" class="block mt-1 w-full" type="text" name="nim"
                                    value="{{ old('nim', Auth::user()->nim) }}" required autofocus />
                                <x-input-error :messages="$errors->get('nim')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input type="text" class="mt-1 block w-full"
                                    placeholder="{{ Auth::user()->email }}" readonly />
                            </div>
                            <!-- No WA -->
                            <div class="mb-4">
                                <x-input-label for="no_wa" value="Nomor WhatsApp" />
                                <x-text-input id="no_wa" class="block mt-1 w-full" type="text" name="no_wa"
                                    value="{{ old('no_wa', Auth::user()->no_wa) }}" required />
                                <x-input-error :messages="$errors->get('no_wa')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="update_password_password" :value="__('New Password')" />
                                <x-text-input id="update_password_password" name="password" type="password"
                                    class="mt-1 block w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="update_password_password_confirmation" name="password_confirmation"
                                    type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                            </div>
                            <!-- Scan KTM -->
                            <div class="mb-4">
                                <x-input-label for="ktm" value="Scan KTM" />
                                <x-text-input id="ktm" class="block mt-1 w-full" type="file" name="ktm" />
                                <x-input-error :messages="$errors->get('ktm')" class="mt-2" />

                                @if (Auth::user()->ktm)
                                    <p class="mt-2 text-sm text-gray-600">File saat ini: <a
                                            href="{{ asset('storage/' . Auth::user()->ktm) }}" target="_blank"
                                            class="text-blue-500 underline">Lihat KTM</a></p>
                                @endif
                            </div>

                            <!-- Foto Anggota -->
                            <div class="mb-4">
                                <x-input-label for="profile" value="Foto Ketua" />
                                <x-text-input id="profile" class="block mt-1 w-full" type="file" name="profile" />
                                <x-input-error :messages="$errors->get('profile')" class="mt-2" />

                                @if (Auth::user()->profile)
                                    <p class="mt-2 text-sm text-gray-600">Foto saat ini:</p>
                                    <img src="{{ asset('storage/' . Auth::user()->profile) }}" alt="Foto Ketua"
                                        class="w-32 h-32 object-cover rounded-lg">
                                @endif
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
