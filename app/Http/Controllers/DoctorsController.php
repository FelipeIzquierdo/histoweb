<?php namespace Histoweb\Http\Controllers;

use Histoweb\Http\Requests\Doctor\CreateRequest;
use Histoweb\Http\Requests\Doctor\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Doctor;
use Histoweb\Specialty;

use Illuminate\Routing\Route;

class DoctorsController extends Controller {

	private $doctor;

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findDoctor', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findDoctor(Route $route)
	{
		$this->doctor = Doctor::findOrFail($route->getParameter('doctors'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $doctors = Doctor::all();

        return view('dashboard.pages.doctor.lists', compact('doctors'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $doctor = new Doctor;
        $form_data = ['route' => 'doctors.store', 'method' => 'POST'];
        $specialties = Specialty::lists('name', 'id' );

        return view('dashboard.pages.doctor.form', compact('doctor','specialties', 'form_data'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        Doctor::create($request->all());
        return redirect()->route('doctors.index');
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return view('dashboard.pages.doctors.show')->whit('docotr', $this->doctor);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => ['doctors.update', $this->doctor->id], 'method' => 'PUT'];
        $specialties = Specialty::allLists();

        return view('dashboard.pages.doctor.form', compact('specialties', 'form_data'))->with('doctor', $this->doctor);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->doctor->fill($request->all());
        $this->doctor->save();

        return redirect()->route('doctors.index');
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
