<?php namespace Histoweb\Http\Middleware;

use Closure;

class AdministratorRole {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{	
		if ($request->user()->roles->name != 'Administrador') {
            return redirect('/');
        }

		return $next($request);
	}
}
