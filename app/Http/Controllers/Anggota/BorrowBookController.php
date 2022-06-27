<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\LibraryRules;
use App\Models\Pivot\BookUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BorrowBookController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $book_id)
    {
        // check whether the user is borrowing or applying for a loan for the books
        $exist = BookUser::where('user_id', auth()->id())
                    ->where('book_id', $book_id)
                    ->whereIn('status', BookUser::$validation)
                    ->first();
        if ($exist) {
            return redirect()->route('anggota.booklist')->with('delete', 'Buku ini sedang kamu pinjam atau ajukan pinjam!');
        }

        // Check Stock
        $stock = Book::find($book_id);
        if ($stock->stock == 0) {
            return redirect()->route('anggota.booklist')->with('delete', 'Buku sedang kosong!');
        }

        // apply for a book loan
        $rules = LibraryRules::first();
        $request->user()->books()->attach($book_id,[
            'status' => 'ASK TO BORROW',
            'return_limit'  => Carbon::now()->addDays($rules->day_limit),
            'fine' => $rules->fine,
        ]);
        return redirect()->route('anggota.booklist')->with('status', 'Peminjaman Sedang Menunggu Persetujuan!');
    }
}
