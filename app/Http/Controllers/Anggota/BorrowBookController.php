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
    public function __invoke(Request $request, Book $book)
    {
        // check whether the user is borrowing or applying for a loan for the books
        $exist = BookUser::where('user_id', auth()->id())
                    ->where('book_id', $book->id)
                    ->whereIn('status', BookUser::$validation)
                    ->first();
        if ($exist) {
            return redirect()->route('anggota.booklist')->with('delete', 'Buku ini sedang kamu pinjam atau ajukan pinjam!');
        }

        // Check Stock
        if ($book->stock == 0) {
            return redirect()->route('anggota.booklist')->with('delete', 'Buku sedang kosong!');
        }

        // apply for a book loan
        $rules = LibraryRules::first();
        $request->user()->books()->attach($book->id, [
            'status' => 'ASK TO BORROW',
            'return_limit'  => Carbon::now()->addDays($rules->day_limit),
            'fine' => $rules->fine,
        ]);

        return redirect()->route('anggota.booklist')->with('status', 'Peminjaman Sedang Menunggu Persetujuan!');
    }
}
