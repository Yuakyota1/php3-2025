<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->status == 0) {
            return redirect()->route('user.profile')->with('error', 'Tài khoản của bạn đã bị khóa.');
        }

        return $next($request);
    }
}

