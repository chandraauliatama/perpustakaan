<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="scale-50" />
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
                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out dark:text-gray-400 dark:hover:text-gray-200 dark:focus:text-gray-200">
                            <div>{{ auth()->user()->name }}</div>

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

                <button x-on:click="themeSwitch()"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out dark:hover:bg-gray-700 dark:hover:text-gray-400 dark:focus:text-gray-400 dark:focus:bg-gray-700">
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" id="darkButton">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg class="hidden w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        id="lightButton">
                        <path fill-rule="evenodd"
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>

            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button x-on:click="themeSwitch()"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out dark:hover:bg-gray-700 dark:hover:text-gray-400 dark:focus:text-gray-400 dark:focus:bg-gray-700">
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        id="mobileDarkButton">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg class="hidden w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        id="mobileLightButton">
                        <path fill-rule="evenodd"
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>

                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out dark:hover:bg-gray-700 dark:hover:text-gray-400 dark:focus:text-gray-400">
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
                <div class="font-medium text-base text-gray-800">{{ auth()->user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
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

<script>
    function hiddenSwitch(what, arr) {
        for (let i = 0; i < arr.length; i++) {
            let svgButton = document.getElementById(arr[i]).classList
            what == "add" ? svgButton.add("hidden") : svgButton.remove("hidden")
        }
    }

    const toggleDark = () => {
        hiddenSwitch("remove", ["lightButton", "mobileLightButton"])
        hiddenSwitch("add", ["darkButton", "mobileDarkButton"])
    }

    const toggleLight = () => {
        hiddenSwitch("remove", ["darkButton", "mobileDarkButton"])
        hiddenSwitch("add", ["lightButton", "mobileLightButton"])
    }

    const userTheme = localStorage.getItem("theme")
    const systemTheme = window.matchMedia("(prefers-colors-scheme: dark)").matches

    const themeCheck = () => {
        if (userTheme == "dark" || (!userTheme && systemTheme)) {
            document.documentElement.classList.add("dark")
            toggleDark()
            return
        }
        toggleLight()
    }

    const themeSwitch = () => {
        if (document.documentElement.classList.contains("dark")) {
            document.documentElement.classList.remove("dark")
            localStorage.setItem("theme", "light")
            toggleLight()
            return
        }
        document.documentElement.classList.add("dark");
        localStorage.setItem("theme", "dark")
        toggleDark()
    }

    themeCheck()
</script>
