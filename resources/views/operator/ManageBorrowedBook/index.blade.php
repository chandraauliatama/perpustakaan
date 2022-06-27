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
                    {{-- <a href="{{ route('operator.borrowed.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Catat Peminjaman Buku') }}</a> --}}
                    {{-- Print Button --}}
                    <a href="{{ route('operator.printAllBooks') }}" target="_blank"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Cetak Laporan') }}</a>

                    {{-- Search Form --}}
                    <form action="{{ route('operator.borrowed.index') }}">
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
                                        <th class="px-4 py-3">Nama</th>
                                        <th class="px-4 py-3">Tanggal Kembali</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">Denda</th>
                                        <th class="px-4 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    @foreach ($borrows as $borrow)
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
                                                        <p class="font-semibold">{{ $borrow->book->title }}</p>
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
                                                {{ $borrow->user->name }}
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ $borrow->return_limit }}
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ $status[$borrow->status] }}
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                @php
                                                    $fine = \Carbon\Carbon::create($borrow->return_limit);
                                                    if (\Carbon\Carbon::now() > $fine && $borrow->status == 'ON LOAN') {
                                                        echo $fine->diffInDays() * $borrow->fine;
                                                    } else {
                                                        echo 0;
                                                    }
                                                @endphp
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center space-x-4 text-sm">
                                                    {{-- <form action="{{ route('operator.book.edit', $borrow) }}"
                                                        method="get">
                                                        <button
                                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 hover:text-purple-900 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                            aria-label="Edit">
                                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path
                                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('operator.book.destroy', $borrow->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                            aria-label="Delete">
                                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                    </form> --}}
                                                    @if ($borrow->status == 'ASK TO BORROW')
                                                        <a href="{{ route('operator.borrowed.edit', $borrow->id) }}">
                                                            <span
                                                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
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
                                                                    class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
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
                                                                    class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
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
                                                                    class="px-2 py-1 font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full dark:bg-blue-700 dark:text-blue-100">
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
