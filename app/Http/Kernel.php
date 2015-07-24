<?php namespace Histoweb\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		'Histoweb\Http\Middleware\VerifyCsrfToken',
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'auth' 				=> 'Histoweb\Http\Middleware\Authenticate',
		'auth.basic' 		=> 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
		'guest' 			=> 'Histoweb\Http\Middleware\RedirectIfAuthenticated',
		'reception_role' 	=> 'Histoweb\Http\Middleware\ReceptionRole',
		'administrator_role'=> 'Histoweb\Http\Middleware\AdministratorRole',
		'doctor_role'=> 'Histoweb\Http\Middleware\DoctorRole'
	];

}
