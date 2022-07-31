<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Ubah Data Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('operator.book.update', $book->id) }}">
                        @csrf
                        @method('PUT')

                        @if ($errors->any())
                            <div class="text-red-500">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Nama Lengkap -->
                        <div>
                            <x-label for="title" :value="__('Judul Buku')" />

                            <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                                :value="$book->title" required autofocus />
                        </div>

                        {{-- Penulis --}}
                        <div class="mt-3">
                            <x-label for="author" :value="__('Penulis')" />

                            <x-input id="author" class="block mt-1 w-full" type="text" name="author"
                                :value="$book->author" required autofocus />
                        </div>

                        {{-- Penerbit --}}
                        <div class="mt-3">
                            <x-label for="publisher" :value="__('Penerbit')" />

                            <x-input id="publisher" class="block mt-1 w-full" type="text" name="publisher"
                                :value="$book->publisher" required autofocus />
                        </div>

                        {{-- Kategori --}}
                        <div class="mt-3">
                            <x-label for="category" :value="__('Kategori')" />

                            <x-input id="category" class="block mt-1 w-full" type="text" name="category"
                                :value="$book->category" required autofocus />
                        </div>

                        {{-- Tahun Terbit --}}
                        <div class="mt-3">
                            <x-label for="year" :value="__('Tahun Terbit')" />

                            <x-input id="year" class="block mt-1 w-full" type="number" name="year"
                                :value="$book->year" required autofocus />
                        </div>

                        {{-- Stok --}}
                        <div class="mt-3">
                            <x-label for="stock" :value="__('Stok')" />

                            <x-input id="stock" class="block mt-1 w-full" type="number" name="stock"
                                :value="$book->stock" required autofocus />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3">
                                {{ __('Ubah Data Buku') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
