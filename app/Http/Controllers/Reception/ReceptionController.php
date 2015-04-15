<?php namespace Histoweb\Http\Controllers\Reception;

use Histoweb\Http\Requests;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Doctor;
use Histoweb\Entities\Diary;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class ReceptionController extends Controller {

	private $patient;
	private $diary;

	public function __construct() 
	{
		$this->beforeFilter('@findDiary', ['only' => ['getActivateDiary']]);
	}

	public function findDiary(Route $route)
	{
		$this->diary = Diary::findOrFail($route->getParameter('one'));
	}

	/**
	 * Display a listing of functions that admin can execute
	 *
	 * @return Response
	 */

	public function getIndex()
	{
		$doctors = Doctor::allLists();
		return view('dashboard.pages.reception.home', compact('doctors'));
	}

	public function getActivateDiary(Request $request, $diary_id)
	{
		dd($this->diary->createEntry());

		if($request->ajax())
		{   	
	        return response()->json([
	            'message' =>     'Cita medica activada correctamente',
	        ]);
	    }
	}

}
