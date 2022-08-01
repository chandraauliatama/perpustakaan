@props(['book'])

<div class="min-w-0 p-4 bg-white text-gray-600 rounded-lg shadow-xs border-2 relative dark:bg-gray-200">
    <h4 class="mb-4 font-bold">
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
                class="px-4 py-2 text-sm font-bold leading-5 text-slate-900 hover:text-slate-200 transition-colors duration-150 bg-slate-400 border border-transparent rounded-lg hover:bg-slate-900 hover:cursor-pointer">
                Ajukan Pinjam
            </button>
        </form>
    </div>
</div>
