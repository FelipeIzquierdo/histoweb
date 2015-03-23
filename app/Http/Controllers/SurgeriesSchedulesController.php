<?php namespace Histoweb\Http\Controllers;

use Histoweb\Http\Requests;
use Histoweb\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SurgeriesSchedulesController extends Controller {

	private $surgery;
	private $days = ['monday' => 'Lunes', 'tuesday' => 'Martes', 'wednesday' => 'Miercoles', 
		'thursday' => 'Jueves', 'friday' => 'Viernes', 'sunday' => 'Sábado'];

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findSurgery');
	}

	/**
	 * Find a specified Surgery resource
	 *
	 */
	public function findSurgery(Route $route)
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
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
