<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class PrintAllUsersController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // retreive all records from db
        $users = User::orderBy('role_id')->get();
        $pdf = PDF::loadView('admin.ManageUser.printAllUsers', compact('users'));
        // download PDF file with download method
        return $pdf->stream();
    }
}
