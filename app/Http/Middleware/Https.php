<?php namespace Histoweb\Http\Middleware;

use Closure;

class Https {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ( ! $request->secure() )
		{
			return redirect()->secure($request->getRequestUri());
        }
		return $next($request); 
	}

}
