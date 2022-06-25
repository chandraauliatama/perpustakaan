<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Semua Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- Print Button --}}
                    <a href="{{ route('pimpinan.printAllBooks') }}" target="_blank"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Cetak Laporan') }}</a>

                    {{-- Search Form --}}
                    <form action="{{ route('pimpinan.books') }}">
                        <x-input id="search" class="mt-1 w-1/2" type="text" name="search"
                            placeholder="Masukan Judul Buku" value="{{ request('search') }}" />
                        <x-button class="mb-3 font-bold">Cari </x-button>
                    </form>

                    {{-- Table Template --}}
                    @if (session())
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2500)">
                            <div class="text-green-500 font-bold mb-4">{{ session('status') }}</div>
                            <div class="text-red-500 font-bold mb-4">{{ session('delete') }}</div>
                        </div>
                    @endif
                    <div class="w-full mt-3 overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3">Judul</th>
                                        {{-- <th class="px-4 py-3">Buku Dipinjam</th> --}}
                                        <th class="px-4 py-3">Penulis</th>
                                        <th class="px-4 py-3">Penerbit</th>
                                        <th class="px-4 py-3">Tahun Terbit</th>
                                        <th class="px-4 py-3">Stok</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    @foreach ($books as $book)
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3">
                                                <div class="flex items-center text-sm">
                                                    <!-- Avatar with inset shadow -->
                                                    {{-- <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                    <img class="object-cover w-full h-full rounded-full"
                                                        src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=200&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                                                        alt="" loading="lazy">
                                                    <div class="absolute inset-0 rounded-full shadow-inner"
                                                        aria-hidden="true"></div>
                                                </div> --}}
                                                    <div>
                                                        <p class="font-semibold">{{ $book->title }}</p>
                                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                                            {{-- 10x Developer --}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- <td class="px-4 py-3 text-sm">
                                                $ 863.45
                                            </td> --}}
                                            <td class="px-4 py-3 text-sm">
                                                {{ $book->author }}
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ $book->publisher }}
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ $book->year }}
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ $book->stock }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $books->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
