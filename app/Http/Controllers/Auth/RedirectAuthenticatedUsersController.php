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
            return to_route('admin.dashboard');
        }
        if (auth()->user()->role_id == Role::IS_PIMPINAN) {
            return to_route('pimpinan.dashboard');
        }
        if (auth()->user()->role_id == Role::IS_OPERATOR) {
            return to_route('operator.dashboard');
        }
        if (auth()->user()->role_id == Role::IS_ANGGOTA) {
            return to_route('anggota.dashboard');
        }
        return auth()->logout();
    }
}
