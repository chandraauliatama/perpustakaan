<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buku Tersedia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('anggota.booklist') }}" class="mb-4">
                        <x-input id="search" class="mt-1 w-3/4 md:w-1/2" type="text" name="search"
                            placeholder="Masukan Judul Buku" value="{{ request('search') }}" />
                        <x-button class="mb-3 font-bold">Cari </x-button>
                    </form>
                    {{-- Status --}}
                    @if (session())
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2500)">
                            <div class="text-green-500 font-bold mb-4">{{ session('status') }}</div>
                            <div class="text-red-500 font-bold mb-4">{{ session('delete') }}</div>
                        </div>
                    @endif
                    {{-- Grid --}}
                    <div class="grid gap-6 mb-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        {{-- Looping --}}
                        @forelse ($books as $book)
                            @if ($loop->iteration % 3 == 0)
                                <div
                                    class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border-2 relative">
                                    <h4 class="mb-4 font-bold text-gray-600 dark:text-gray-300">
                                        {{ $book->title }}
                                    </h4>
                                    <p class="text-gray-600 dark:text-gray-400">Penulis: {{ $book->author }} </p>
                                    <p class="text-gray-600 dark:text-gray-400">Penerbit: {{ $book->publisher }} </p>
                                    <p class="text-gray-600 dark:text-gray-400">Tahun Terbit: {{ $book->year }} </p>
                                    <p class="text-gray-600 dark:text-gray-400">Stok: {{ $book->stock }} </p>
                                    <div class="absolute bottom-0 right-0">
                                        <form action="{{ route('anggota.borrow', $book->id) }}" method="POST">
                                            @csrf
                                            <button
                                                class="px-4 py-2 text-sm font-bold leading-5 text-slate-900 hover:text-slate-200 transition-colors duration-150 bg-slate-400 border border-transparent rounded-lg hover:bg-slate-900 hover:cursor-pointer">
                                                Ajukan Pinjam
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @elseif($loop->iteration == 2 || $loop->iteration == 5 || $loop->iteration == 8 || $loop->iteration == 11)
                                <div class="min-w-0 p-4 text-white bg-slate-300 rounded-lg shadow-xs relative">
                                    <h4 class="mb-4 font-bold text-gray-600 dark:text-gray-300">
                                        {{ $book->title }}
                                    </h4>
                                    <p class="text-gray-700 dark:text-gray-400">Penulis: {{ $book->author }} </p>
                                    <p class="text-gray-700 dark:text-gray-400">Penerbit: {{ $book->publisher }} </p>
                                    <p class="text-gray-700 dark:text-gray-400">Tahun Terbit: {{ $book->year }} </p>
                                    <p class="text-gray-700 dark:text-gray-400">Stok: {{ $book->stock }} </p>
                                    <div class="absolute bottom-0 right-0">
                                        <form action="{{ route('anggota.borrow', $book->id) }}" method="POST">
                                            @csrf
                                            <button
                                                class="px-4 py-2 text-sm font-bold leading-5 text-white transition-colors duration-150 bg-slate-600 border border-transparent rounded-lg hover:bg-slate-900 hover:cursor-pointer">
                                                Ajukan Pinjam
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="min-w-0 p-4 text-white bg-slate-500 rounded-lg shadow-xs relative">

                                    <h4 class="mb-4 font-semibold">
                                        {{ $book->title }}
                                    </h4>
                                    <p>Penulis: {{ $book->author }} </p>
                                    <p>Penerbit: {{ $book->publisher }} </p>
                                    <p>Tahun Terbit: {{ $book->year }} </p>
                                    <p>Stok: {{ $book->stock }} </p>
                                    <div class="absolute bottom-0 right-0">
                                        <form action="{{ route('anggota.borrow', $book->id) }}" method="POST">
                                            @csrf
                                            <button
                                                class="px-4 py-2 text-sm font-bold leading-5 text-white hover:text-slate-900 transition-colors duration-150 bg-slate-800 border border-transparent rounded-lg hover:bg-slate-300 hover:cursor-pointer">
                                                Ajukan Pinjam
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="col-span-2">
                                <h1 class="col-span-3 text-red-600 text-center text-xl font-bold">
                                    Buku dengan judul tersebut tidak ditemukan
                                </h1>
                            </div>
                        @endforelse
                    </div>
                    <div class="mt-4">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
