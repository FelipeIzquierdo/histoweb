<?php namespace Histoweb\Http\Middleware;

use Closure;

class Rol {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next, $rolName)
	{	
		if ($request->user()->roles->name != $rolName) {
            return redirect('/');
        }

		return $next($request);
	}
}
