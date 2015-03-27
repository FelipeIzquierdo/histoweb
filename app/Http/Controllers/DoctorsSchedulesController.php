<?php namespace Histoweb\Http\Controllers;

use Histoweb\Http\Requests\Schedule\CreateRequest;
use Histoweb\Http\Requests\Schedule\EditRequest;

use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Doctor;
use Histoweb\Entities\Schedule;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;

class DoctorsSchedulesController extends Controller {

	private $doctor;
    protected $schedule;
	private $days = ['monday' => 'Lunes', 'tuesday' => 'Martes', 'wednesday' => 'Miercoles', 
		'thursday' => 'Jueves', 'friday' => 'Viernes', 'saturday' => 'Sábado'];

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findDoctor');
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
        $url = route('doctors.schedules.json', $this->doctor->id);
        return view('dashboard.pages.doctor.schedules', compact('url'))->with('doctor', $this->doctor);
	}

    /**
     * Display a listing of the resource in JSON.
     *
     * @return Response JSON
     */
    public function json($doctor_id)
    {
        return $this->doctor->schedules->toJson();
    }
}
