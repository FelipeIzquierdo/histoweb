<?php namespace Histoweb\Http\Controllers\Admin\Company\Doctor;

use Histoweb\Entities\Diary;
use Histoweb\Entities\DiaryType;
use Histoweb\Entities\DocType;
use Histoweb\Entities\Occupation;
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
        $occupations = Occupation::allLists();
        $doc_types = DocType::allLists();
        $genders = Patient::$genders;

		$url = route(self::$prefixRoute . 'json', $this->doctor->id);
		return view(self::$prefixView . 'diaries', compact('url', 'diaryTypes','occupations', 'doc_types', 'genders'))->with('doctor', $this->doctor);

	}

    /**
     * Display a listing of the resource in JSON.
     *
     * @return Response JSON
     */
    public function store(CreateRequest $request)
    {


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

    public function newDiary(Request $request, $doctor_id, $patient_id, $diary_type_id){

        $patient = Patient::findOrFail($patient_id);
        $diaryType = DiaryType::findOrFail($diary_type_id);

        $newDiary = [
            'patient_id'        => $patient->id,
            'patient_name'      => $patient->name,
            'diary_type_time'   => $diaryType->time,
        ];
        
        return $newDiary;
    }
}
