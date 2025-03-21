<nav x-data="{ open: false }" class="bg-blue-800 border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:flex">

                    @if(Auth::user()->role === 'ketua_tim')
                        <x-nav-link :href="route('ketua.dashboard')" :active="request()->routeIs('ketua.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('tim.index')" :active="request()->routeIs('tim.index')">
                            {{ __('Tim') }}
                        </x-nav-link>
                        <x-nav-link :href="route('anggota.index')" :active="request()->routeIs('anggota.index')">
                            {{ __('Anggota') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pembayaran.index')" :active="request()->routeIs('pembayaran.index')">
                            {{ __('Pembayaran') }}
                        </x-nav-link>
                        <x-nav-link :href="route('berkas.index')" :active="request()->routeIs('berkas.index')">
                            {{ __('Berkas') }}
                        </x-nav-link>
                        <x-nav-link :href="route('final.submit.index')" :active="request()->routeIs('final.submit.index')">
                            {{ __('Preview') }}
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->role === 'admin')
                        <!-- Link ke Dashboard Admin -->
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>

                        <!-- Link ke Manajemen Pembayaran -->
                        <x-nav-link :href="route('payment-management.index')" :active="request()->routeIs('payment-management.index')">
                            {{ __('Pembayaran') }}
                        </x-nav-link>
                        
                        <!-- Link ke Verifikasi Berkas -->
                        <x-nav-link :href="route('document-verification.index')" :active="request()->routeIs('document-verification.index')">
                            {{ __('Berkas') }}
                        </x-nav-link>

                        <!-- Link ke Pengelolaan Kategori Lomba -->
                        <x-nav-link :href="route('competition-category.index')" :active="request()->routeIs('competition-category.index')">
                            {{ __('Kategori') }}
                        </x-nav-link>

                        <!-- Link ke Laporan Pendaftaran -->
                        <x-nav-link :href="route('report.index')" :active="request()->routeIs('report.index')">
                            {{ __('Laporan') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
        @if(Auth::user()->role === 'ketua_tim')
                        <x-responsive-nav-link :href="route('ketua.dashboard')" :active="request()->routeIs('ketua.dashboard')">
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('tim.index')" :active="request()->routeIs('tim.index')">
                            {{ __('Tim') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('anggota.index')" :active="request()->routeIs('anggota.index')">
                            {{ __('Anggota') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('pembayaran.index')" :active="request()->routeIs('pembayaran.index')">
                            {{ __('Pembayaran') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('berkas.index')" :active="request()->routeIs('berkas.index')">
                            {{ __('Berkas') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('final.submit.index')" :active="request()->routeIs('final.submit.index')">
                            {{ __('Preview') }}
                        </x-responsive-nav-link>
                    @endif

                    @if(Auth::user()->role === 'admin')
                        <!-- Link ke Dashboard Admin -->
                        <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>

                        <!-- Link ke Manajemen Pembayaran -->
                        <x-responsive-nav-link :href="route('payment-management.index')" :active="request()->routeIs('payment-management.index')">
                            {{ __('Pembayaran') }}
                        </x-responsive-nav-link>
                        
                        <!-- Link ke Verifikasi Berkas -->
                        <x-responsive-nav-link :href="route('document-verification.index')" :active="request()->routeIs('document-verification.index')">
                            {{ __('Berkas') }}
                        </x-responsive-nav-link>

                        <!-- Link ke Pengelolaan Kategori Lomba -->
                        <x-responsive-nav-link :href="route('competition-category.index')" :active="request()->routeIs('competition-category.index')">
                            {{ __('Kategori') }}
                        </x-responsive-nav-link>

                        <!-- Link ke Laporan Pendaftaran -->
                        <x-responsive-nav-link :href="route('report.index')" :active="request()->routeIs('report.index')">
                            {{ __('Laporan') }}
                        </x-responsive-nav-link>
                    @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-white">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
