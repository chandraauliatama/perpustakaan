<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Pivot\BookUser;

class ManageBorrowedBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrows = BookUser::orderBy('status');
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('operator.ManageBorrowedBook.create');
    }

    public function edit($id)
    {
        $borrow = BookUser::find($id);
        $book = Book::find($borrow->book_id);
        $borrow->status = 'ON LOAN';
        $book->stock--;
        $borrow->save();
        $book->save();

        return redirect()->route('operator.borrowed.index')->with('status', 'Buku disetujui untuk dipinjam!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $borrow = BookUser::find($id);
        $book = Book::find($borrow->book_id);
        $borrow->status = 'RETURNED';
        $book->stock++;
        $borrow->save();
        $book->save();

        return redirect()->route('operator.borrowed.index')->with('status', 'Buku telah dikembalikan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $borrow = BookUser::find($id);
        if ($borrow->status == 'ASK TO BORROW') {
            $borrow->delete();

            return redirect()->route('operator.borrowed.index')->with('delete', 'Permintaaan peminjaman ditolak');
        }
        $borrow->delete();

        return redirect()->route('operator.borrowed.index')->with('delete', 'Data Peminjaman Dihapus');
    }
}
