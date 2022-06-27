<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Pivot\BookUser;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $allBooks = BookUser::where('user_id', auth()->user()->id);
        $allBook = $allBooks->count();
        $borrowedBooks = $allBooks->where('status', 'ON LOAN')->count();
        $requestedBooks = BookUser::where('user_id', auth()->user()->id)->where('status', 'ASK TO BORROW')->count();
        $returnedBooks = BookUser::where('user_id', auth()->user()->id)->where('status', 'RETURNED')->count();
        return view('anggota.dashboard', compact('allBook', 'borrowedBooks', 'requestedBooks', 'returnedBooks'));
    }
}
