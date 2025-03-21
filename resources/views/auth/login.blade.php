<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mt-4 mb-8 text-center font-bold text-3xl"><h1>Sign In</h1></div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Tombol Login -->
        <div class="mt-4">
            <x-primary-button  class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Forgot Password -->
        <div class="mt-2 flex justify-center text-center">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- (or) di tengah -->
        <div class="mt-4 my-4 flex items-center">
            <hr class="w-full border-gray-300">
            <span class="px-3 text-gray-500 text-sm">or</span>
            <hr class="w-full border-gray-300">
        </div>

        <!-- Login dengan Google -->
        <div class="mt-2 text-center">
            <a href="{{ route('google.login') }}" class="flex items-center justify-center bg-gray-200 hover:bg-gray-300 text-gray-600 hover:text-gray-900 font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 w-full">
                <img src="https://img.icons8.com/color/48/000000/google-logo.png" class="w-5 h-5 mr-2" alt="Google Icon">
                Login dengan Google
            </a>
        </div>
    </form>
</x-guest-layout>