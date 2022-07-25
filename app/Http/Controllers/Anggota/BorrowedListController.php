<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Pivot\BookUser;
use Illuminate\Http\Request;

class BorrowedListController extends Controller
{
    public function __invoke(Request $request)
    {
        $books = BookUser::orderBy('status')->where('user_id', auth()->id());
        if (request('search')) {
            $books->whereHas('book', function ($query) {
                $query->where('title', 'like', '%'.request('search').'%')
                    ->Orwhere('author', 'like', '%'.request('search').'%')
                    ->Orwhere('publisher', 'like', '%'.request('search').'%')
                    ->Orwhere('stock', request('search'))
                    ->Orwhere('year', request('search'));
            });
        }
        $books = $books->paginate(10)->withQueryString();

        return view('anggota.borrowedList', compact('books'));
    }
}
