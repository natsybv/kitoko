<?php

namespace App\Http\Middleware;

use Closure;

class Cart
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
        if (session()->has('cart')) {
          return $next($request);
        }

        return redirect()->route('cart.index');
    }
}
