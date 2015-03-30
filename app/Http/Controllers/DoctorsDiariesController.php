<?php namespace Histoweb\Http\Controllers;

use Histoweb\Entities\Diary;
use Histoweb\Http\Requests;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Doctor;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class DoctorsDiariesController extends Controller {

	private $doctor;
	
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
		$url = route('doctors.diaries.json', $this->doctor->id);
		return view('dashboard.pages.doctor.diaries', compact('url'))->with('doctor', $this->doctor);
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
