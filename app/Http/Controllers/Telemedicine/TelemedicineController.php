<?php namespace Histoweb\Http\Controllers\Telemedicine;

use Histoweb\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class TelemedicineController extends Controller {


	/**
	 * Display a listing of functions that doctor can execute
	 *
	 * @return Response
	 */

	public function __construct() 
	{
	}

	public function getIndex()
	{	
		return view('dashboard.pages.telemedicine.home');
	}

	public function getTelediagnostic()
	{
		return view('dashboard.pages.telemedicine.telediagnostics.home');
	}

	public function getTeleconsult()
	{
		return view('dashboard.pages.telemedicine.teleconsult.home');
	}

	public function getLlamada()
	{
		
	}

}
