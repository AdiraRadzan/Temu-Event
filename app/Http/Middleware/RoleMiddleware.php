<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Check if user is approved (except for admins)
        if ($user->status !== 'approved' && !$user->isAdmin()) {
            return redirect()->route('login')
                ->with('error', 'Akun Anda belum diverifikasi oleh admin.');
        }

        // Check role permissions
        if (!in_array($user->role, $roles)) {
            abort(403, 'Unauthorized access. Insufficient permissions.');
        }

        return $next($request);
    }
}
