<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookListController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $books = Book::orderBy('title');
        if (request('search')) {
            $books->where('title', 'like', '%' . request('search') . '%');
        }
        $books = $books->paginate(12)->withQueryString();
        return view('anggota.booklist', compact('books'));
    }
}
