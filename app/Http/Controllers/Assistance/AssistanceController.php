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
use Histoweb\Entities\Diagnosis;
use Histoweb\Entities\HistoryType;
use Histoweb\Entities\OrderProcedure;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Response;
class AssistanceController extends Controller {

	private $diaries;
	private $entry;
	private $reasons;
	private $systemRevisions;
	private $procedures;
	private $doctor;
	private $diagnoses;
	private $historyTypes;

	/**
	 * Display a listing of functions that doctor can execute
	 *
	 * @return Response
	 */

	public function __construct() 
	{
		$this->beforeFilter('@findDoctor');
		$this->beforeFilter('@findDiaries', ['only' => ['getIndex', 'getEntries', 'getOptions']]);
		$this->beforeFilter('@findEntry', ['only' => ['getEntries', 'postHistory', 'getOptions']]);
		//$this->beforeFilter('@verificActiveEntry', ['only' => ['getEntries', 'postHistory']]);
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
		$this->diagnoses = Diagnosis::allLists();
		$this->historyTypes = HistoryType::withHistories();
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
			'procedures'		=> $this->procedures,
			'diagnoses'			=> $this->diagnoses,
			'historyTypes'		=> $this->historyTypes
		]);
	}

	public function postHistory(CreateRequest $request, $id)
	{
		$this->entry->saveHistory($request->all());

		return redirect()->route('assistance.entries.options', $id);
	}

	public function getOptions($id)
	{	
		$order_procedure = OrderProcedure::orderBy('updated_at', 'desc')->paginate(12);
		return view('dashboard.pages.assistance.options')->with([
			'diaries' 	=> $this->diaries,
			'doctor'	=> $this->doctor,
			'entry' 	=> $this->entry,
			'order_procedure' => $order_procedure,
			'id'		=> $id,
            'pdf'       =>'http://www.yopalenlinea.gov.co/hacienda/documentos/39839.pdf'
		]);
	}

	public function getPdf($id)
	{	
		$filename = public_path().'documents/'.$id;
		return Response::download($filename);
	}

	public function getFormulate($id)
	{	
		return view('dashboard.pages.assistance.options')->with([
			'diaries' 	=> $this->diaries,
			'doctor'	=> $this->doctor,
			'entry' 	=> $this->entry
		]);
	}
}
