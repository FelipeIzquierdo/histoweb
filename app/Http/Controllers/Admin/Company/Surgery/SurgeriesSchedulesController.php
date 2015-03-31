<?php namespace Histoweb\Http\Controllers\Admin\Company\Surgery;


use Histoweb\Entities\Availability;
use Histoweb\Http\Requests\Schedule\CreateMassiveRequest;
use Histoweb\Http\Requests\Schedule\CreateRequest;
use Histoweb\Http\Requests\Schedule\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Surgery;
use Histoweb\Entities\Schedule;
use Histoweb\Entities\Doctor;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;

class SurgeriesSchedulesController extends Controller {

	private $surgery;
    protected $schedule;
	private $days = ['monday' => 'Lunes', 'tuesday' => 'Martes', 'wednesday' => 'Miercoles', 
		'thursday' => 'Jueves', 'friday' => 'Viernes', 'saturday' => 'Sábado'];

    private static $prefixRoute = 'admin.company.surgeries.schedules.';
    private static $prefixView = 'dashboard.pages.admin.company.surgery.schedule.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findSurgery');
        $this->beforeFilter('@findSchedules', ['only' => ['update', 'destroy']]);
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
     * Find a specified Schedules resource
     *
     */
    public function findSchedules(Route $route)
    {
        $this->schedule = $this->surgery->schedules()->find($route->getParameter('schedules'));
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($surgery_id)
	{
        $url = route(self::$prefixRoute . 'json', $this->surgery->id);
        return view(self::$prefixView . 'lists', compact('url','surgery_id'))->with('surgery', $this->surgery);
	}

    /**
     * Display a listing of the resource in JSON.
     *
     * @return Response JSON
     */
    public function json($surgery_id)
    {
        return \Calendar::getSchedulesAvailabilities($this->surgery->schedules, Availability::allStateAvailable($this->surgery->id));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $schedule  = new Schedule ;
        $form_data = ['route' => [self::$prefixRoute . 'store', $this->surgery->id], 'method' => 'POST'];
        $doctors = Doctor::allLists();
        return view(self::$prefixView . 'form', compact('schedule', 'form_data','doctors'))->with('days', $this->days);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storeMassive(CreateMassiveRequest $request, $surgery_id)
    {
        $schedule = new Schedule($request->all());
        $schedule->save();
        if($request->ajax())
        {
            return response()->json([
                'message' =>     'Evento actualizado con exito',
            ]);
        }
    }


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request, $surgery_id)
	{
        $doctor = $request->input('doctor_id');
        $events = \Calendar::eventsOfData($request->all());
        $schedules = array();

        foreach ($events as $event)
        {
            array_push($schedules, new Schedule($event + ['doctor_id' => $doctor]));
        }
        $this->surgery->schedules()->saveMany($schedules);
        return redirect()->route(self::$prefixRoute . 'index', $this->surgery->id);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditRequest $request, $doctor_id, $id)
	{
        $this->schedule->fill($request->all());
        $this->schedule->save();

        if($request->ajax())
        {
            return response()->json([
                'message' =>     'Evento actualizado con exito',
            ]);
        }
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function discard(Request $request, $surgery_id, $id)
    {
        $this->surgery->discardedAvailabilities()->attach($id);

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
	public function destroy(Request $request, $surgery_id, $id)
	{
        $this->schedule->delete();
        if($request->ajax())
        {
            return response()->json([
                'message' =>     'Evento eliminado con exito',
            ]);
        }
	}

}
