@props(['book'])

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
