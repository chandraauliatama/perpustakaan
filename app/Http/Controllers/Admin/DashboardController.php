<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Pivot\BookUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $totalUsers = User::count();
        $admin = User::where('role_id', '1')->count();
        $pimpinan = User::where('role_id', '2')->count();
        $operator = User::where('role_id', '3')->count();
        $anggota = User::where('role_id', '4')->count();
        $totalBooks = Book::sum('stock');
        $newUserThisWeek = User::where('created_at', '>', Carbon::now()->startOfWeek())->where('created_at', '<', Carbon::now()->endOfWeek())->count();
        $borrowedBooks = BookUser::where('status', 'ON LOAN')->count();

        return view('admin.dashboard', compact('totalUsers', 'totalBooks', 'newUserThisWeek', 'borrowedBooks', 'admin', 'pimpinan', 'operator', 'anggota'));
    }
}
