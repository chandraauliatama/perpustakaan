<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
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
        $exist = BookUser::where('user_id', auth()->id())
                    ->where('book_id', $book_id)
                    ->whereIn('status', ['REQUEST', 'ON LOAN'])
                    ->first();
        if ($exist) {
            return redirect()->route('anggota.booklist')->with('delete', 'Buku ini sedang kamu pinjam atau ajukan pinjam!');
        }

        $rules = LibraryRules::first();
        $request->user()->books()->attach($book_id,[
            'status' => 'REQUEST',
            'return_limit'  => Carbon::now()->addDays($rules->day_limit),
            'fine' => $rules->fine,
        ]);
        return redirect()->route('anggota.booklist')->with('status', 'Peminjaman Sedang Menunggu Persetujuan!');
    }
}
