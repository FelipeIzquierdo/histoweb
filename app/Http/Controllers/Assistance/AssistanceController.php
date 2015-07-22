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

use Response, Input, DateTime;
class AssistanceController extends Controller {

	private $diaries;
	private $diary;
	private $entry;
	private $doctor;
	private static $RoutePdfHistoryClinic = '/documents/historyClinic/';
	private static $RoutePdfListsProcedures = '/documents/';

	/**
	 * Display a listing of functions that doctor can execute
	 *
	 * @return Response
	 */

	public function __construct() 
	{
		$this->beforeFilter('@findDoctor');
		$this->beforeFilter('@findDiaries', ['only' => ['getIndex', 'getCreateEntry','getOptions']]);
		$this->beforeFilter('@findEntry', ['only' => [ 'getExit', 'getOptions','getRemoveProcedure','getPdf']]);
		$this->beforeFilter('@findDiary', ['only' => ['getCreateEntry', 'postHistory']]);
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

	public function getIndex()
	{	
		return view('dashboard.pages.assistance.home')->with([
			'diaries' 	=> $this->diaries,
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
			'diaries'			=> $this->diaries, 
			'diary'				=> $this->diary
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
		$entry = $this->diary->getNewOrFirstEntry();
		if(!$entry->exists)
		{
			$entry->saveHistory($request->all());
			$pdf = new MyPdf();
			$pdf->historyPdf($this->diary->entry,$request->all());
		}
		return redirect()->route('assistance.entries.options', $this->diary->entry->id);
	}

	public function getOptions($id)
	{	
		$list_formulates = Formulate::ListsViews();
		$form_data = ['route' => ['assistance.entries.removeprocedure',$this->entry->id], 'method' => 'POST', 'id' => 'entryForm'];
		$order_procedures = OrderProcedure::getListsOrderProcedures($this->entry->id);
        $describe_procedures = DescribeProcedure::getDescribeProcedures($this->entry->id);
		
		return view('dashboard.pages.assistance.options',compact('form_data','list_formulates'))->with([
			'diaries' 	=> $this->diaries,
			'doctor'	=> $this->doctor,
			'entry' 	=> $this->entry,
			'order_procedures' => $order_procedures,
            'describe_procedures' => $describe_procedures,
			'id'		=> $id,
            'pdf'       => self::$RoutePdfHistoryClinic
		]);
	}

	public function getPdf($id)
	{	
		$filename = public_path().self::$RoutePdfListsProcedures.$id.'.pdf';
		if(\File::exists($filename))
			return Response::download($filename,'Procedimientos.pdf');
		return redirect()->route('assistance.entries.options', $this->entry->id);
	}

	public function getRemoveProcedure($entry)
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
			'diaries' 	=> $this->diaries,
			'doctor'	=> $this->doctor,
			'entry' 	=> $this->entry
		]);
	}
}
