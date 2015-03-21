<?php namespace Histoweb\Http\Controllers;

use Histoweb\Http\Requests\Specialty\CreateRequest;
use Histoweb\Http\Requests\Specialty\EditRequest;

use Histoweb\Http\Controllers\Controller;
use Histoweb\Entities\Specialty;

use Illuminate\Routing\Route;

class SpecialtiesController extends Controller {

	private $specialty;

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

		return view('dashboard.pages.specialty.lists', compact('specialties'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$specialty = new Specialty;
		$form_data = ['route' => 'specialties.store', 'method' => 'POST'];

		return view('dashboard.pages.specialty.form', compact('specialty', 'form_data'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request)
	{
		$this->specialty = Specialty::create($request->all());

        return redirect()->route('specialties.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{	
		return view('dashboard.pages.specialty.show', compact('specialty'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$form_data = ['route' => ['specialties.update', $this->specialty->id], 'method' => 'PUT'];

		return view('dashboard.pages.specialty.form', compact('form_data'))->with('specialty', $this->specialty);
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

        return redirect()->route('specialties.index');
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
