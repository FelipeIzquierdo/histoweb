<?php namespace Histoweb\Http\Controllers\Assistance;

use Histoweb\Http\Requests;
use Histoweb\Http\Controllers\Controller;
use Histoweb\Http\Requests\Entry\History\CreateRequest;
use Histoweb\Components\Pdf\PdfBuilder as MyPdf;

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

use Response, Input, DateTime;
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
		$this->beforeFilter('@findEntry', ['only' => ['getEntries', 'getExit','postHistory', 'getOptions','getRemoveProcedure']]);
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

	public function findDiary(Route $route)
	{
		$this->diary = Diary::findOrFail($route->getParameter('one'));
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

	public function getCreateEntry($diary_id)
	{
		$entry = Entry::create(['diary_id' => $this->diary->id]);
		$entry->save();

		return redirect()->route('assistance.entries', $entry->id);
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


	public function getExit()
	{
		$dt = new DateTime();
		$this->entry->exit_at = $dt->format('Y-m-d H:i:s');
		$this->entry->save();
		
		return redirect()->route('assistance');
	}

	public function postHistory(CreateRequest $request, $id)
	{
		$this->entry->saveHistory($request->all());
        $pdf = new MyPdf();
        $pdf->historyPdf($this->entry,$request->all());
		return redirect()->route('assistance.entries.options', $id);
	}

	public function getOptions($id)
	{	
		$form_data = ['route' => ['assistance.entries.removeprocedure',$this->entry->id], 'method' => 'POST', 'id' => 'entryForm'];
		$order_procedure = OrderProcedure::where('entry_id','=',$this->entry->id)->orderBy('updated_at', 'desc')->paginate(12);
		return view('dashboard.pages.assistance.options',compact('form_data'))->with([
			'diaries' 	=> $this->diaries,
			'doctor'	=> $this->doctor,
			'entry' 	=> $this->entry,
			'order_procedure' => $order_procedure,
			'id'		=> $id,
            'pdf'       => '/documents/historyClinic/'.$id.'.pdf'
		]);
	}

	public function getPdf($id)
	{	
		$filename = public_path().'/documents/'.$id.'.pdf';
		return Response::download($filename,'Procedimientos.pdf');
	}

	public function getRemoveProcedure($entry)
	{	
		$id = Input::get('procedure');
		OrderProcedure::removeProcedure($this->entry->id,$id);
		return redirect()->route('assistance.entries.options', $this->entry->id);
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
