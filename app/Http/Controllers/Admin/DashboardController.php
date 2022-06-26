<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
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
        $newUserThisWeek = User::where('created_at', '>', Carbon::now()->startOfWeek()) ->where('created_at', '<', Carbon::now()->endOfWeek()) ->count();
        return view('admin.dashboard', compact('totalUsers', 'totalBooks', 'newUserThisWeek'));
    }
}
