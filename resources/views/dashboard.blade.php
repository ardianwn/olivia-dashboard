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

                    <form method="post" action="{{ route('pass.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')
                        <div>
                            <x-input-label for="nama_lengkap" value="Nama Lengkap" />
                            <x-text-input type="text" class="mt-1 block w-full "
                                placeholder="{{ Auth::user()->name }}" readonly />
                        </div>
                        <br>
                        <!-- NIM -->
                        <div class="mb-4">
                            <x-input-label for="nim" value="NIM" />
                            <x-text-input id="nim" class="block mt-1 w-full" type="text" name="nim"
                                value="{{ old('nim') }}" required autofocus />
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
                                value="{{ old('no_wa') }}" required />
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
                            <x-input-label for="scan_ktm" value="Scan KTM" />
                            <x-text-input id="scan_ktm" class="block mt-1 w-full" type="file" name="scan_ktm"
                                required />
                            <x-input-error :messages="$errors->get('scan_ktm')" class="mt-2" />
                        </div>

                        <!-- Foto Anggota -->
                        <div class="mb-4">
                            <x-input-label for="profile" value="Foto Ketua" />
                            <x-text-input id="profile" class="block mt-1 w-full" type="file" name="profile"
                                required />
                            <x-input-error :messages="$errors->get('profile')" class="mt-2" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'password-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
