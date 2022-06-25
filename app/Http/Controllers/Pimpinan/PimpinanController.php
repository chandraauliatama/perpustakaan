<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\LibraryRules;
use Illuminate\Http\Request;
use PDF;

class PimpinanController extends Controller
{
    public function getAllBooks()
    {
        $books = Book::orderBy('title');
        if (request('search')) {
            $books->where('title', 'like', '%' . request('search') . '%');
        }
        $books = $books->paginate(10)->withQueryString();
        return view('pimpinan.allBooks', compact('books'));
    }

    public function printAllBooks()
    {
          // retreive all records from db
        $books = Book::orderBy('title')->get();
        $pdf = PDF::loadView('pimpinan.printAllBooks', compact('books'));
        // download PDF file with download method
        return $pdf->stream();
    }

    public function getBorrowedBooks()
    {
        return view('pimpinan.borrowedBooks');
    }

    public function lendingRules()
    {
        $rules = LibraryRules::first();
        return view('pimpinan.lendingRules', compact('rules'));
    }

    public function storeLendingRules(Request $request)
    {
        $newRules = $request->validate([
            'day_limit' => 'required|numeric',
            'fine' => 'required|numeric|min:3',
        ]);
        $rules = LibraryRules::first();
        $rules->update($newRules);
        return redirect()->route('pimpinan.lendingRules')->with('status', 'Aturan Berhasil Diubah!');
    }
}
