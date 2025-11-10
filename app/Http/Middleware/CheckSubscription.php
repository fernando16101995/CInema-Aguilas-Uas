<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CheckSubscription
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (!$user || !$user->suscripcion_activa || ($user->suscripcion_expira && Carbon::now()->greaterThan($user->suscripcion_expira))) {
            return redirect()->route('stripe.form')->with('error', 'Necesitas una suscripción activa para acceder.');
        }
        return $next($request);
    }
}
