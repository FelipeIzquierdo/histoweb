<?php namespace Histoweb\Http\Controllers\Admin\System;

use Histoweb\Http\Requests\Specialty\CreateRequest;
use Histoweb\Http\Requests\Specialty\EditRequest;

use Histoweb\Http\Controllers\Controller;
use Histoweb\Entities\Specialty;

use Illuminate\Routing\Route;

class SpecialtiesController extends Controller {

	private $specialty;
	private static $prefixRoute = 'admin.system.specialties.';
	private static $prefixView = 'dashboard.pages.admin.system.doctor.specialty.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findSpecialty', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findSpecialty(Route $route)
	{
		$this->specialty = Specialty::findOrFail($route->getParameter('specialties'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$specialties = Specialty::paginate(12);

		return view(self::$prefixView . 'lists', compact('specialties'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$specialty = new Specialty;
		$form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

		return view(self::$prefixView . 'form', compact('specialty', 'form_data'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request)
	{
		$this->specialty = Specialty::create($request->all());

        return redirect()->route(self::$prefixRoute . 'index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{	
		return view(self::$prefixView . 'show', compact('specialty'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$form_data = ['route' => [self::$prefixRoute . 'update', $this->specialty->id], 'method' => 'PUT'];

		return view(self::$prefixView . 'form', compact('form_data'))->with('specialty', $this->specialty);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditRequest $request, $id)
	{
        $this->specialty->fill($request->all());
        $this->specialty->save();

        return redirect()->route(self::$prefixRoute . 'index');
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
