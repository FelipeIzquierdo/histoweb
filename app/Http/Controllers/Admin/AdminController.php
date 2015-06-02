<?php namespace Histoweb\Http\Controllers\Admin;

use Histoweb\Http\Requests;
use Histoweb\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminController extends Controller {

	/**
	 * Display a listing of functions that admin can execute
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return view('dashboard.pages.admin.home');
		//dd(__DIR__ . '/../config/breadcrumbs.php');
	}

}
