<?php namespace Histoweb\Http\Controllers\Admin\Company\Surgery;

use Histoweb\Http\Requests\Availability\CreateMassiveRequest;
use Histoweb\Http\Requests\Availability\CreateRequest;
use Histoweb\Http\Requests\Availability\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Surgery;
use Histoweb\Entities\Availability;
use Histoweb\Entities\Doctor;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;

class SurgeriesAvailabilitiesController extends Controller {

	private $surgery;
    protected $availability;
	private $days = ['monday' => 'Lunes', 'tuesday' => 'Martes', 'wednesday' => 'Miercoles', 
		'thursday' => 'Jueves', 'friday' => 'Viernes', 'saturday' => 'Sábado'];

    private static $prefixRoute = 'admin.company.surgeries.availabilities.';
    private static $prefixView = 'dashboard.pages.admin.company.surgery.availability.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findSurgery');
        $this->beforeFilter('@findAvailability', ['only' => ['update', 'destroy']]);
	}

	/**
	 * Find a specified Surgery resource
	 *
	 */
	public function findSurgery(Route $route)
	{
		$this->surgery = Surgery::findOrFail($route->getParameter('surgeries'));
	}

    /**
     * Find a specified Availabilitys resource
     *
     */
    public function findAvailability(Route $route)
    {
        $this->availability = $this->surgery->availabilities()->findOrFail($route->getParameter('availabilities'));
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
        return \Calendar::getAvailabilities(
            $this->surgery->availabilities, 
            Availability::allPersonalAvailable($this->surgery->id)
        );
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $availability  = new Availability;
        $form_data = ['route' => [self::$prefixRoute . 'store', $this->surgery->id], 'method' => 'POST'];
        $doctors = Doctor::allLists();
        return view(self::$prefixView . 'form', compact('availability', 'form_data','doctors'))->with(['days' => $this->days, 'surgery' => $this->surgery]);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storeMassive(CreateMassiveRequest $request, $surgery_id)
    {
        $availability = new Availability($request->all() + ['surgery_id' => $surgery_id]);
        $availability->save();

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
        $availabilities = array();

        foreach ($events as $event)
        {
            array_push($availabilities, new Availability($event + ['doctor_id' => $doctor, 'surgery_id' => $surgery_id, 'group_id' => Availability::nextGroupId()]));
        }
        $this->surgery->availabilities()->saveMany($availabilities);
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
        $this->availability->delete();
        
        if($request->ajax())
        {
            return response()->json([
                'message' =>     'Evento eliminado con exito',
            ]);
        }
	}

}
