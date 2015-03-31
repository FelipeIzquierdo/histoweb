<?php namespace Histoweb\Http\Controllers\Admin\Company\Doctor;

use Histoweb\Entities\Diary;
use Histoweb\Http\Requests;
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
		$url = route(self::$prefixRoute . 'json', $this->doctor->id);
		return view(self::$prefixView . 'diaries', compact('url'))->with('doctor', $this->doctor);
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
