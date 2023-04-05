<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dasbor Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-black">
                    {{-- Search Form --}}
                    <form action="{{ route('anggota.borrowedList') }}">
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
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700">
                                        <th class="px-4 py-3">Judul</th>
                                        {{-- <th class="px-4 py-3">Buku Dipinjam</th> --}}
                                        <th class="px-4 py-3">Penulis</th>
                                        <th class="px-4 py-3">Tahun Terbit</th>
                                        <th class="px-4 py-3">Tanggal Kembali</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">Denda</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:bg-gray-800">
                                    @foreach ($books as $book)
                                        <tr class="text-gray-700 dark:text-gray-400 dark:border-gray-700">
                                            <td class="px-4 py-3">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <p class="font-semibold">{{ $book->book->title }}</p>
                                                        <p class="text-xs text-gray-600 ">
                                                            {{-- 10x Developer --}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ $book->book->author }}
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ $book->book->year }}
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ $book->return_limit }}
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ \app\Models\Pivot\BookUser::$statuses[$book->status] }}
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ calculatingFines($book) }}
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
