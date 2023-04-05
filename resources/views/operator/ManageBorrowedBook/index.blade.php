<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Semua Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="border-b border-gray-200 bg-white p-6 dark:border-black dark:bg-gray-800">
                    {{-- Print Button --}}
                    <x-button ahref href="{{ route('operator.printAllBooks') }}" target="_blank">{{ __('Cetak Laporan') }}
                    </x-button>
                    {{-- Search Form --}}
                    <form action="{{ route('operator.borrowed.index') }}">
                        <x-input id="search" class="mt-1 w-1/2" type="text" name="search"
                            placeholder="Masukan Kata Kunci Pencarian..." value="{{ request('search') }}" />
                        <x-button class="mb-3 font-bold">Cari </x-button>
                    </form>

                    {{-- Table Template --}}
                    @if (session('status') || session('delete'))
                        <x-session-message></x-session-message>
                    @endif
                    <div class="shadow-xs mt-3 w-full overflow-hidden rounded-lg">
                        <div class="w-full overflow-x-auto">
                            <table class="whitespace-no-wrap w-full">
                                <thead>
                                    <tr
                                        class="border-b bg-gray-50 text-left text-xs font-bold uppercase tracking-wide text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                                        <th class="px-4 py-3">Judul</th>
                                        {{-- <th class="px-4 py-3">Buku Dipinjam</th> --}}
                                        <th class="px-4 py-3">Nama</th>
                                        <th class="px-4 py-3">Tanggal Kembali</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">Denda</th>
                                        <th class="px-4 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y bg-white dark:bg-gray-800">
                                    @foreach ($borrows as $borrow)
                                        <tr class="text-gray-700 dark:border-gray-700 dark:text-gray-400">
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
                                                        <p class="font-semibold">{{ $borrow->book->title }}</p>
                                                        <p class="text-xs text-gray-600">
                                                            {{-- 10x Developer --}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- <td class="px-4 py-3 text-sm">
                                                $ 863.45
                                            </td> --}}
                                            <td class="px-4 py-3 text-sm">
                                                {{ $borrow->user->name }}
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ $borrow->return_limit }}
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ $status[$borrow->status] }}
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ calculatingFines($borrow) }}
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center space-x-4 text-sm">
                                                    @if ($borrow->status == 'ASK TO BORROW')
                                                        <a href="{{ route('operator.borrowed.edit', $borrow->id) }}">
                                                            <span
                                                                class="focus:shadow-outline-red rounded-full border border-green-400 bg-green-200 px-2 py-1 text-sm font-bold leading-5 text-green-700 transition-colors duration-150 hover:bg-green-500 hover:text-green-50 focus:outline-none active:bg-green-600 dark:border-transparent dark:bg-green-600 dark:text-white dark:hover:bg-green-800">
                                                                Setujui
                                                            </span>
                                                        </a>
                                                        <form
                                                            action="{{ route('operator.borrowed.destroy', $borrow->id) }}"
                                                            method="POST">
                                                            <button type="submit">
                                                                @csrf
                                                                @method('DELETE')
                                                                <span
                                                                    class="focus:shadow-outline-red rounded-full border border-red-400 bg-red-200 px-2 py-1 text-sm font-bold leading-5 text-red-700 transition-colors duration-150 hover:bg-red-500 hover:text-red-50 focus:outline-none active:bg-red-600 dark:border-transparent dark:bg-red-600 dark:text-white dark:hover:bg-red-800">
                                                                    Tolak
                                                                </span>
                                                            </button>
                                                        </form>
                                                    @elseif ($borrow->status == 'RETURNED')
                                                        <form
                                                            action="{{ route('operator.borrowed.destroy', $borrow->id) }}"
                                                            method="POST">
                                                            <button type="submit">
                                                                @csrf
                                                                @method('DELETE')
                                                                <span
                                                                    class="focus:shadow-outline-red rounded-full border border-red-400 bg-red-200 px-2 py-1 text-sm font-bold leading-5 text-red-700 transition-colors duration-150 hover:bg-red-500 hover:text-red-50 focus:outline-none active:bg-red-600 dark:border-transparent dark:bg-red-600 dark:text-white dark:hover:bg-red-800">
                                                                    Hapus Data
                                                                </span>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form
                                                            action="{{ route('operator.borrowed.update', $borrow->id) }}"
                                                            method="POST">
                                                            <button type="submit">
                                                                @csrf
                                                                @method('PUT')
                                                                <span
                                                                    class="focus:shadow-outline-blue rounded-full border border-blue-400 bg-blue-200 px-2 py-1 text-sm font-bold leading-5 text-blue-700 transition-colors duration-150 hover:bg-blue-500 hover:text-blue-50 focus:outline-none active:bg-blue-600 dark:border-transparent dark:bg-blue-600 dark:text-white dark:hover:bg-blue-800">
                                                                    Kembalikan
                                                                </span>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $borrows->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
