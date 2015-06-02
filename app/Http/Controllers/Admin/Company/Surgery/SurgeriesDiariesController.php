<?php namespace Histoweb\Http\Controllers\Admin\Company\Surgery;

use Histoweb\Http\Requests;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Surgery;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class SurgeriesDiariesController extends Controller {

	private $surgery;
	private static $prefixRoute = 'admin.company.surgeries.diaries.';
    private static $prefixView = 'dashboard.pages.admin.company.surgery.';
	
	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@finSurgery');
	}


	/**
	 * Find a specified Surgery resource
	 *
	 */
	public function finSurgery(Route $route)
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
		$url = route(self::$prefixRoute . 'json', $this->surgery->id);
		return view(self::$prefixView . 'diaries', compact('url'))->with('surgery', $this->surgery);
	}

	/**
	 * Display a listing of the resource in JSON.
	 *
	 * @return Response JSON
	 */
	public function json($surgery_id)
	{
		return \Calendar::getSurgeryDiaries($this->surgery);
	}
}
