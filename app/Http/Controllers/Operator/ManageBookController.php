<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use PDF;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class ManageBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('title');
        if (request('search')) {
            $books->where('title', 'like', '%' . request('search') . '%')
                ->Orwhere('author', 'like', '%' . request('search') . '%')
                ->Orwhere('publisher', 'like', '%' . request('search') . '%')
                ->Orwhere('stock', request('search'))
                ->Orwhere('year', request('search'));
        }
        $books = $books->paginate(10)->withQueryString();
        return view('operator.ManageBook.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('operator.ManageBook.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'author' => 'required',
            'publisher' => 'required',
            'category' => 'required',
            'year' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);
        Book::create($book);
        return redirect()->route('operator.book.index')->with('status', 'Buku Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        return view('operator.ManageBook.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:255',
            'author' => 'required',
            'publisher' => 'required',
            'category' => 'required',
            'year' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);
        $book = Book::find($id);
        $book->fill($request->all())->save();
        return redirect()->route('operator.book.index')->with('status', 'Data Buku Berhasil Diubah!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
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
