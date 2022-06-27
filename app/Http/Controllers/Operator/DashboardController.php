<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Pivot\BookUser;
use App\Models\User;
use Carbon\Carbon;
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
        $totalUsers = User::count();
        $totalBooks = Book::sum('stock');
        $bookRequest = BookUser::where('status', 'ASK TO BORROW')->count();
        $borrowedBooks = BookUser::where('status', 'ON LOAN')->count();
        return view('operator.dashboard', compact('totalUsers', 'totalBooks', 'bookRequest', 'borrowedBooks'));
    }
}
