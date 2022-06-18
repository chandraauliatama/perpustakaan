<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if ($role == 'admin' && auth()->user()->role_id != Role::IS_ADMIN) {
            abort(403);
        }
        if ($role == 'pimpinan' && auth()->user()->role_id != Role::IS_PIMPINAN) {
            abort(403);
        }
        if ($role == 'operator' && auth()->user()->role_id != Role::IS_OPERATOR) {
            abort(403);
        }
        if ($role == 'anggota' && auth()->user()->role_id != Role::IS_ANGGOTA) {
            abort(403);
        }
        return $next($request);
    }
}
