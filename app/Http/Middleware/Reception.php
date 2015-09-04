<?php namespace Histoweb\Http\Middleware;

use Closure;

class Reception {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ( $request->user()->role_id == '3' || $request->user()->role_id == '1') // Recepcionista
		{
			return $next($request);
        }
		return redirect()->route('admin');
	}

}
