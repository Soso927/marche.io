<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Récupère l'utilisateur courant avec un type explicite pour l'analyse statique.
        /** @var User|null $user */
        $user = $request->user();

        // Vérifie qu'un utilisateur est connecté et qu'il possède le rôle administrateur.
        if (!$user || !$user->is_admin) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
