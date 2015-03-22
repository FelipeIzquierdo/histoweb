<?php namespace Histoweb\Http\Controllers;

use Histoweb\Http\Requests\Availability\CreateRequest;
use Histoweb\Http\Requests\Availability\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Doctor;
use Histoweb\Entities\Availability;

use Illuminate\Routing\Route;

class DoctorsAvailabilitiesController extends Controller {

	private $availability;
	private $doctor;
	private $days = ['monday' => 'Lunes', 'tuesday' => 'Martes', 'wednesday' => 'Miercoles', 
		'thursday' => 'Jueves', 'friday' => 'Viernes', 'sunday' => 'Sábado'];

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findDoctor');
		$this->beforeFilter('@findAvailability', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	/**
	 * Find a specified Availability resource 
	 *
	 */
	public function findAvailability(Route $route)
	{
		$this->availability = $this->doctor->availabilities()->findOrFail($route->getParameter('availabilities'));
	}

	/**
	 * Find a specified Doctor resource
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
	public function index($doctor_id)
	{
		$availabilities = $this->doctor->availabilities;
		return view('dashboard.pages.availability.lists', compact('availabilities'))->with('doctor', $this->doctor);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$availability  = new Availability ;
        $form_data = ['route' => ['doctors.availabilities.store', $this->doctor->id], 'method' => 'POST'];

        return view('dashboard.pages.availability.form', compact('availability', 'form_data'))->with('days', $this->days);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request, $doctor_id)
	{
		$events = \Calendar::eventsOfData($request->all());
		$availabilities = array();

		foreach ($events as $event) 
		{
			array_push($availabilities, new Availability($event));
		}

		$this->doctor->availabilities()->saveMany($availabilities);

		return redirect()->route('doctors.availabilities.index', $this->doctor->id);
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
