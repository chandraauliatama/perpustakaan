<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\LibraryRules;
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
        $totalBooks = Book::sum('stock');
        $rules = LibraryRules::first();
        $borrowedBooks = BookUser::where('status', 'ON LOAN')->count();
        return view('pimpinan.dashboard', compact('rules', 'totalBooks', 'borrowedBooks'));
    }
}
