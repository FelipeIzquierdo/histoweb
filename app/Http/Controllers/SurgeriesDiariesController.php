<?php namespace Histoweb\Http\Controllers;

use Histoweb\Http\Requests;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Surgery;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class SurgeriesDiariesController extends Controller {

	private $surgery;
	
	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findDoctor');
	}


	/**
	 * Find a specified Surgery resource
	 *
	 */
	public function findDoctor(Route $route)
	{
		$this->surgery = Surgery::find($route->getParameter('surgeries'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($surgery_id)
	{
		$url = route('surgeries.diaries.json', $this->surgery->id);
		return view('dashboard.pages.surgery.diaries', compact('url'))->with('surgery', $this->surgery);
	}

	/**
	 * Display a listing of the resource in JSON.
	 *
	 * @return Response JSON
	 */
	public function json($surgery_id)
	{
		return \Calendar::diariesAndAvailableSchedule($this->doctor->diaries, $this->doctor->schedules);
	}
}
