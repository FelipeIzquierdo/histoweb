<?php namespace Histoweb\Http\Controllers\Admin\System\Medicament;

use Histoweb\Http\Requests;
use Histoweb\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MedicamentController extends Controller {

	/**
	 * Display a listing of functions that admin can execute
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return view('dashboard.pages.admin.system.medicament.home');
	}

}
