<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Pivot\BookUser;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $status = array_keys(BookUser::$statuses);
        $allBook = BookUser::where('user_id', auth()->id())->count();
        $requestedBooks = BookUser::where('user_id', auth()->id())->where('status', $status[0])->count();
        $borrowedBooks = BookUser::where('user_id', auth()->id())->where('status', $status[1])->count();
        $returnedBooks = BookUser::where('user_id', auth()->id())->where('status', $status[2])->count();

        return view('anggota.dashboard', compact('allBook', 'borrowedBooks', 'requestedBooks', 'returnedBooks'));
    }
}
