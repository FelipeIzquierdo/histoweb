<?php namespace Histoweb\Http\Middleware;

use Closure;

class Admin {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ( $request->user()->role_id == '2' || $request->user()->role_id == '1') // Administrador
		{
			return $next($request);
        }
		return redirect()->route('admin');
	}

}
