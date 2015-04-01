<?php namespace Histoweb\Http\Controllers\Admin\Company\Doctor;

use Histoweb\Entities\Diary;
use Histoweb\Entities\DiaryType;
use Histoweb\Entities\Patient;
use Histoweb\Http\Requests;
use Histoweb\Http\Requests\Diary\CreateRequest;
use Histoweb\Http\Requests\Diary\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Doctor;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class DoctorsDiariesController extends Controller {

	private $doctor;
	private static $prefixRoute = 'admin.company.doctors.diaries.';
	private static $prefixView = 'dashboard.pages.admin.company.doctor.';
	
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

        $diaryTypes = DiaryType::allLists();
        $patients = Patient::allLists();
		$url = route('doctors.diaries.json', $this->doctor->id);
		return view('dashboard.pages.doctor.diaries', compact('url', 'diaryTypes', 'patients'))->with('doctor', $this->doctor);

		$url = route(self::$prefixRoute . 'json', $this->doctor->id);
		return view(self::$prefixView . 'diaries', compact('url'))->with('doctor', $this->doctor);

	}

    /**
     * Display a listing of the resource in JSON.
     *
     * @return Response JSON
     */
    public function store(CreateRequest $request)
    {
        dd($request->all());
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
	 * Display a listing of the resource in JSON.
	 *
	 * @return Response JSON
	 */
	public function json($doctor_id)
	{
		return \Calendar::getSchedulesDiaries($this->doctor);
	}
}
