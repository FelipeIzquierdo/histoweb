<?php namespace Histoweb\Http\Controllers\Videoconferencing;

use Histoweb\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class VideoconferencingController extends Controller {


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
		return view('dashboard.pages.videoconferencing.home');
	}
}
