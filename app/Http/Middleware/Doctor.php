<?php namespace Histoweb\Http\Middleware;

use Closure;

class Doctor {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ( $request->user()->role_id == '4' || $request->user()->role_id == '6'  || $request->user()->role_id == '1') // medico
		{
			return $next($request);
        }
		return redirect()->route('admin');
	}

}
