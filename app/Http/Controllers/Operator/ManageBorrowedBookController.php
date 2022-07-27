<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Pivot\BookUser;

class ManageBorrowedBookController extends Controller
{
    public function index()
    {
        $borrows = BookUser::with('book', 'user')->orderBy('status');
        if (request('search')) {
            $borrows->whereHas('book', function ($query) {
                $query->where('title', 'like', '%'.request('search').'%')
                    ->Orwhere('author', 'like', '%'.request('search').'%')
                    ->Orwhere('publisher', 'like', '%'.request('search').'%')
                    ->Orwhere('stock', request('search'))
                    ->Orwhere('year', request('search'));
            });
        }
        $borrows = $borrows->paginate(10)->withQueryString();
        $status = BookUser::$statuses;

        return view('operator.ManageBorrowedBook.index', compact('borrows', 'status'));
    }

    /**
     * Accept Request Loan Book and Decrease Book Stock.
     *
     * @param  BookUser  $borrowed
     * @return \Illuminate\Http\Response
     */
    public function edit(BookUser $borrowed)
    {
        $book = Book::find($borrowed->book_id);
        $borrowed->status = 'ON LOAN';
        $book->stock--;
        $borrowed->save();
        $book->save();

        return redirect()->route('operator.borrowed.index')->with('status', 'Buku disetujui untuk dipinjam!');
    }

    public function update(BookUser $borrowed)
    {
        $book = Book::find($borrowed->book_id);
        $borrowed->status = 'RETURNED';
        $book->stock++;
        $borrowed->save();
        $book->save();

        return redirect()->route('operator.borrowed.index')->with('status', 'Buku telah dikembalikan!');
    }

    public function destroy(BookUser $borrowed)
    {
        if ($borrowed->status == 'ASK TO BORROW') {
            $borrowed->delete();

            return redirect()->route('operator.borrowed.index')->with('delete', 'Permintaaan peminjaman ditolak');
        }

        $borrowed->delete();

        return redirect()->route('operator.borrowed.index')->with('delete', 'Data Peminjaman Dihapus');
    }
}
