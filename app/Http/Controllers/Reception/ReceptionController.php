<?php namespace Histoweb\Http\Controllers\Reception;

use Histoweb\Http\Requests;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Doctor;

use Illuminate\Http\Request;

class ReceptionController extends Controller {

	/**
	 * Display a listing of functions that admin can execute
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$doctors = Doctor::allLists();
		return view('dashboard.pages.reception.home', compact('doctors'));
	}

}
