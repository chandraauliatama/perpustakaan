<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\LibraryRules;
use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    public function getAllBooks()
    {
        return view('pimpinan.allBooks');
    }

    public function getBorrowedBooks()
    {
        return view('pimpinan.borrowedBooks');
    }

    public function lendingRules()
    {
        $rules = LibraryRules::first();
        return view('pimpinan.lendingRules', compact('rules'));
    }

    public function storeLendingRules(Request $request)
    {
        $newRules = $request->validate([
            'day_limit' => 'required|numeric',
            'fine' => 'required|numeric|min:3',
        ]);
        $rules = LibraryRules::first();
        $rules->update($newRules);
        return redirect()->route('pimpinan.lendingRules')->with('status', 'Aturan Berhasil Diubah!');
    }
}
