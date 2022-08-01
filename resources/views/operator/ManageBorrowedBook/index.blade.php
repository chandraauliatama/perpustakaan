<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Semua Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-black">
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
                    <div class="w-full mt-3 overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr
                                        class="text-xs font-bold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700">
                                        <th class="px-4 py-3">Judul</th>
                                        {{-- <th class="px-4 py-3">Buku Dipinjam</th> --}}
                                        <th class="px-4 py-3">Nama</th>
                                        <th class="px-4 py-3">Tanggal Kembali</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">Denda</th>
                                        <th class="px-4 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:bg-gray-800">
                                    @foreach ($borrows as $borrow)
                                        <tr class="text-gray-700 dark:text-gray-400 dark:border-gray-700">
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
                                                        <p class="text-xs text-gray-600 ">
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
                                                    if (now() > $fine && $borrow->status == 'ON LOAN') {
                                                        echo $fine->diffInDays() * $borrow->fine;
                                                    } else {
                                                        echo 0;
                                                    }
                                                @endphp
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center space-x-4 text-sm">
                                                    @if ($borrow->status == 'ASK TO BORROW')
                                                        <a href="{{ route('operator.borrowed.edit', $borrow->id) }}">
                                                            <span
                                                                class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150  bg-green-600 border border-transparent rounded-full active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green">
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
                                                                    class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-full active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
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
                                                                    class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-full active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
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
                                                                    class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent  rounded-full active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
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
