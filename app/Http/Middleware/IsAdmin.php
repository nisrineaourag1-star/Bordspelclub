<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Laat het request enkel door als de ingelogde gebruiker admin is.
     * Niet-admins krijgen een 403. Niet-ingelogde bezoekers gaan naar login.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        if (! $request->user()->isAdmin()) {
            abort(403, 'Je hebt geen toegang tot deze pagina.');
        }

        return $next($request);
    }
}
