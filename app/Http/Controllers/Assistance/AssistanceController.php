<?php namespace Histoweb\Http\Controllers\Assistance;

use Histoweb\Entities\DescribeProcedure;
use Histoweb\Http\Requests;
use Histoweb\Http\Controllers\Controller;
use Histoweb\Http\Requests\Entry\History\CreateRequest;
use Histoweb\Components\Pdf\PdfBuilder as MyPdf;

use Histoweb\Entities\Diary;
use Histoweb\Entities\Entry;
use Histoweb\Entities\Doctor;
use Histoweb\Entities\Procedure;
use Histoweb\Entities\OrderProcedure;
use Histoweb\Entities\Formulate;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Response, Input, Auth;
class AssistanceController extends Controller {

	private $diaries;
	private $diary;
	private $entry;
	private $doctor;
	private static $RoutePdfListsProcedures = '/documents/';

	/**
	 * Display a listing of functions that doctor can execute
	 *
	 * @return Response
	 */

	public function __construct() 
	{
		$this->beforeFilter('@findDoctor');
		$this->beforeFilter('@findEntry', ['only' => [ 'getExit', 'getOptions','getRemoveProcedure','getPdf']]);
		$this->beforeFilter('@findDiary', ['only' => ['getCreateEntry', 'postHistory']]);
	}

	public function findDoctor()
	{
		$this->doctor = Auth::user()->office;
	}

	public function findEntry(Route $route)
	{
		$this->entry = Entry::findOrFail($route->getParameter('one'));
	}

	public function findDiary(Route $route)
	{
		$this->diary = Diary::findOrFail($route->getParameter('one'));
	}

	public function getIndex()
	{	
		return view('dashboard.pages.assistance.home')->with([
			'doctor'	=> $this->doctor
		]);
	}

	public function getCreateEntry($diary_id)
	{ 
		if($this->diary->entry)
		{
			return redirect()->route('assistance.entries.options', $this->diary->entry->id);
		}
		return view('dashboard.pages.assistance.entry')->with([
			'diary'	=> $this->diary,
			'doctor'	=> $this->doctor
		]);
	}

	public function getExit()
	{
		$this->entry->setExit();
		return redirect()->route('assistance');
	}

	public function postHistory(CreateRequest $request, $id)
	{
		$entry = $this->diary->getNewOrFirstEntry();
		if( ! $entry->exists )
		{
			$entry->saveHistory($request->all());
			$pdf = new MyPdf();
			$pdf->historyPdf( $entry , $entry );
		}
		return redirect()->route('assistance.entries.options', $entry->id);
	}

	public function getOptions($id)
	{	
		$formulations = $this->entry->getFormulatePaginate();
		$form_data = ['route' => ['assistance.entries.removeprocedure',$this->entry->id], 'method' => 'POST', 'id' => 'entryForm'];
		
		return view('dashboard.pages.assistance.options',compact('form_data','formulations'))->with([
			'doctor'				=> $this->doctor,
			'entry' 				=> $this->entry
		]);
	}

	public function getPdf($id)
	{	
		$filename = public_path().self::$RoutePdfListsProcedures.$id.'.pdf';
		
		if(\File::exists($filename))
		{
			return Response::download($filename,'Procedimientos.pdf');	
		}
			
		return redirect()->route('assistance.entries.options', $this->entry->id);
	}

	public function getRemoveProcedure($entry_id)
	{	
		OrderProcedure::removeProcedure( $this->entry->id, Input::get('procedure') );
		$rta = Procedure::getOrderProceduresAll($this->entry->id);
        $pdf = new MyPdf();
        $pdf->orderProceduresPdf($rta,$this->entry);

		return redirect()->route('assistance.entries.options', $this->entry->id);
	}

	public function getFormulate($id)
	{	
		return view('dashboard.pages.assistance.options')->with([
			'doctor'	=> $this->doctor,
			'entry' 	=> $this->entry
		]);
	}
}
