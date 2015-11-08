<?php namespace Histoweb\Http\Middleware;

use Closure;

class DoctorRole {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{	
		if ($request->user()->roles->name != 'Medico') {
            return redirect('/');
        }

		return $next($request);
	}
}
