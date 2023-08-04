<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CheckGroupAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        // khusus admin dan kepala sekolah
        if ($user && ($user->id_group === 1 || $user->id_group === 2)) {
            return $next($request);
        }

        Session::flash('failed', 'You do not have access to that page.');

        return back();
    }
}
