<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //on vérifie si l'utilisateur est connecté
        if (Auth::check()){
          $user = Auth::user();
          if ($user->role === 1){
            return $next($request); //passe la requete suivante
          }
        }

        //on redirige vers une erreur 403: pas d'accès à la ressource demandée
        abort(403);
    }
}
