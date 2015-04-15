<?php namespace Histoweb\Http\Controllers\Assistance;

use Histoweb\Http\Requests;
use Histoweb\Http\Controllers\Controller;
use Histoweb\Http\Requests\Entry\History\CreateRequest;

use Histoweb\Entities\Diary;
use Histoweb\Entities\Entry;
use Histoweb\Entities\Doctor;
use Histoweb\Entities\Reason;
use Histoweb\Entities\SystemRevision;
use Histoweb\Entities\Procedure;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class AssistanceController extends Controller {

	private $diaries;
	private $entry;
	private $reasons;
	private $systemRevisions;
	private $procedures;
	private $doctor;

	/**
	 * Display a listing of functions that doctor can execute
	 *
	 * @return Response
	 */

	public function __construct() 
	{
		$this->beforeFilter('@findDoctor');
		$this->beforeFilter('@findDiaries', ['only' => ['getIndex', 'getEntries']]);
		$this->beforeFilter('@findEntry', ['only' => ['getEntries', 'postHistory']]);
		$this->beforeFilter('@verificActiveEntry', ['only' => ['getEntries', 'postHistory']]);
		$this->beforeFilter('@loadPatientRelations', ['only' => ['getEntries']]);
	}

	public function findDoctor()
	{
		$this->doctor = Doctor::find(1);
	}

	public function findDiaries()
	{
		$this->diaries = $this->doctor->getDiariesToday();
	}

	public function findEntry(Route $route)
	{
		$this->entry = Entry::findOrFail($route->getParameter('one'));
	}

	public function verificActiveEntry(Route $route)
	{	
		if(!$this->entry->isActive())
		{
			\App::abort('404');
		}
	}

	public function loadPatientRelations()
	{
		$this->reasons = Reason::allLists();
		$this->systemRevisions = SystemRevision::allLists();
		$this->procedures = Procedure::allLists();
	}

	public function getIndex()
	{	
		return view('dashboard.pages.assistance.home')->with([
			'diaries' 	=> $this->diaries,
			'doctor'	=> $this->doctor 
		]);
	}

	public function getEntries($id)
	{
		return view('dashboard.pages.assistance.entry')->with([
			'diaries'			=> $this->diaries, 
			'entry' 			=> $this->entry,
			'reasons'			=> $this->reasons,
			'system_revisions'	=> $this->systemRevisions,
			'procedures'		=> $this->procedures
		]);
	}

	public function postHistory(CreateRequest $request, $id)
	{
		$this->entry->saveHistory($request->all());

		return redirect()->route('assistance');
	}

}
