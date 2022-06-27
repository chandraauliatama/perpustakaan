<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    {{-- Nav Admin --}}
                    @if (auth()->user()->role_id == 1)
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Dasbor Admin') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.user.index')" :active="request()->routeIs('admin.user.index')">
                            {{ __('Kelola User') }}
                        </x-nav-link>
                    @endif
                    {{-- Nav Pimpinan --}}
                    @if (auth()->user()->role_id == 2)
                        <x-nav-link :href="route('pimpinan.dashboard')" :active="request()->routeIs('pimpinan.dashboard')">
                            {{ __('Dasbor Pimpinan') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pimpinan.books')" :active="request()->routeIs('pimpinan.books')">
                            {{ __('Buku Tersedia') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pimpinan.borrowedBooks')" :active="request()->routeIs('pimpinan.borrowedBooks')">
                            {{ __('Buku Dipinjam') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pimpinan.lendingRules')" :active="request()->routeIs('pimpinan.lendingRules')">
                            {{ __('Aturan Peminjaman') }}
                        </x-nav-link>
                    @endif
                    {{-- Nav Operator --}}
                    @if (auth()->user()->role_id == 3)
                        <x-nav-link :href="route('operator.dashboard')" :active="request()->routeIs('operator.dashboard')">
                            {{ __('Dasbor Operator') }}
                        </x-nav-link>
                        <x-nav-link :href="route('operator.book.index')" :active="request()->routeIs('operator.book.index')">
                            {{ __('Kelola Buku') }}
                        </x-nav-link>
                        <x-nav-link :href="route('operator.borrowed.index')" :active="request()->routeIs('operator.borrowed.index')">
                            {{ __('Catatan Peminjaman Buku') }}
                        </x-nav-link>
                    @endif
                    {{-- Nav Anggota --}}
                    @if (auth()->user()->role_id == 4)
                        <x-nav-link :href="route('anggota.dashboard')" :active="request()->routeIs('anggota.dashboard')">
                            {{ __('Dasbor') }}
                        </x-nav-link>
                        <x-nav-link :href="route('anggota.booklist')" :active="request()->routeIs('anggota.booklist')">
                            {{ __('Buku Tersedia') }}
                        </x-nav-link>
                        <x-nav-link :href="route('anggota.borrowedList')" :active="request()->routeIs('anggota.borrowedList')">
                            {{ __('Catatan Peminjaman') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
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
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{-- Responsive Nav Admin --}}
            @if (auth()->user()->role_id == 1)
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Dasbor') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.user.index')" :active="request()->routeIs('admin.user.index')">
                    {{ __('Kelola User') }}
                </x-responsive-nav-link>
            @endif
            {{-- Responsive Nav Pimpinan --}}
            @if (auth()->user()->role_id == 2)
                <x-responsive-nav-link :href="route('pimpinan.dashboard')" :active="request()->routeIs('pimpinan.dashboard')">
                    {{ __('Dasbor Pimpinan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pimpinan.books')" :active="request()->routeIs('pimpinan.books')">
                    {{ __('Buku Tersedia') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pimpinan.borrowedBooks')" :active="request()->routeIs('pimpinan.borrowedBooks')">
                    {{ __('Buku Dipinjam') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pimpinan.lendingRules')" :active="request()->routeIs('pimpinan.lendingRules')">
                    {{ __('Aturan Peminjaman') }}
                </x-responsive-nav-link>
            @endif
            {{-- Responsive Nav Operator --}}
            @if (auth()->user()->role_id == 3)
                <x-responsive-nav-link :href="route('operator.dashboard')" :active="request()->routeIs('operator.dashboard')">
                    {{ __('Dasbor Operator') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('operator.book.index')" :active="request()->routeIs('operator.book.index')">
                    {{ __('Kelola Buku') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('operator.book.index')" :active="request()->routeIs('operator.book.index')">
                    {{ __('Catatan Peminjaman Buku') }}
                </x-responsive-nav-link>
            @endif
            {{-- Responsive Nav Anggota --}}
            @if (auth()->user()->role_id == 4)
                <x-responsive-nav-link :href="route('anggota.dashboard')" :active="request()->routeIs('anggota.dashboard')">
                    {{ __('Dasbor') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('anggota.booklist')" :active="request()->routeIs('anggota.booklist')">
                    {{ __('Buku Tersedia') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
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
