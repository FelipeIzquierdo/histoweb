<?php namespace Histoweb\Http\Controllers;

use Histoweb\Http\Requests\Availability\CreateRequest;
use Histoweb\Http\Requests\Availability\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Doctor;
use Histoweb\Entities\Availability;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;

class DoctorsAvailabilitiesController extends Controller {

	private $availability;
	private $doctor;
	private $days = ['monday' => 'Lunes', 'tuesday' => 'Martes', 'wednesday' => 'Miercoles', 
		'thursday' => 'Jueves', 'friday' => 'Viernes', 'sunday' => 'Sábado'];

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findDoctor');
		$this->beforeFilter('@findAvailability', ['only' => ['update', 'destroy']]);
	}


	/**
	 * Find a specified Availability resource 
	 *
	 */
	public function findAvailability(Route $route)
	{
		$this->availability = $this->doctor->availabilities()->find($route->getParameter('availabilities'));
	}

	/**
	 * Find a specified Doctor resource
	 *
	 */
	public function findDoctor(Route $route)
	{
		$this->doctor = Doctor::find($route->getParameter('doctors'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($doctor_id)
	{
		$url = route('doctors.availabilities.json', $this->doctor->id);
		return view('dashboard.pages.availability.lists', compact('url'))->with('doctor', $this->doctor);
	}

	/**
	 * Display a listing of the resource in JSON.
	 *
	 * @return Response JSON
	 */
	public function json($doctor_id)
	{
		return $this->doctor->availabilities->toJson();
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
		$nextGroupId = Availability::nextGroupId();
		
		foreach ($events as $event) 
		{
			array_push($availabilities, new Availability($event + ['group_id' => $nextGroupId]));
		}

		$this->doctor->availabilities()->saveMany($availabilities);

		return redirect()->route('doctors.availabilities.index', $this->doctor->id);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditRequest $request, $doctor_id, $id)
	{
		$this->availability->fill($request->all());
		$this->availability->save();

		if($request->ajax())
		{   	
	        return response()->json([
	            'message' =>     'Evento actualizado con exito',
	        ]);
	    }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request, $doctor_id, $id)
	{
		$this->availability->delete();
		if($request->ajax())
		{   
	        return response()->json([
	            'message' =>     'Evento eliminado con exito',
	        ]);
	    }
	}

}
