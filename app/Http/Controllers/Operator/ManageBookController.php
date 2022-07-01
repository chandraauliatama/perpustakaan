<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use PDF;

class ManageBookController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('title');
        if (request('search')) {
            $books->where('title', 'like', '%'.request('search').'%')
                ->Orwhere('author', 'like', '%'.request('search').'%')
                ->Orwhere('publisher', 'like', '%'.request('search').'%')
                ->Orwhere('stock', request('search'))
                ->Orwhere('year', request('search'));
        }
        $books = $books->paginate(10)->withQueryString();

        return view('operator.ManageBook.index', compact('books'));
    }

    public function create()
    {
        return view('operator.ManageBook.create');
    }

    public function store(Request $request)
    {
        $book = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'author' => 'required',
            'publisher' => 'required',
            'category' => 'required',
            'year' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);
        Book::create($book);

        return redirect()->route('operator.book.index')->with('status', 'Buku Berhasil Ditambahkan!');
    }

    public function edit(Book $book)
    {
        return view('operator.ManageBook.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:255',
            'author' => 'required',
            'publisher' => 'required',
            'category' => 'required',
            'year' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);
        $book->fill($request->all())->save();

        return redirect()->route('operator.book.index')->with('status', 'Data Buku Berhasil Diubah!');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('operator.book.index')->with('delete', 'Buku Berhasil Dihapus!');
    }

    public function printAllBooks()
    {
        // retreive all records from db
        $books = Book::orderBy('title')->get();
        $pdf = PDF::loadView('pimpinan.printAllBooks', compact('books'));
        // download PDF file with download method
        return $pdf->stream();
    }
}
