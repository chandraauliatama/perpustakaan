<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RedirectAuthenticatedUsersController extends Controller
{
    public function home()
    {
        if (auth()->user()->role_id == Role::IS_ADMIN) {
            return redirect('/admin/tes');
        }
        if (auth()->user()->role_id == Role::IS_PIMPINAN) {
            return redirect('/pimpinan/tes');
        }
        if (auth()->user()->role_id == Role::IS_OPERATOR) {
            return redirect('/operator/tes');
        }
        if (auth()->user()->role_id == Role::IS_ANGGOTA) {
            return redirect('/anggota/tes');
        }
        return auth()->logout();
    }
}
