<?php namespace Histoweb\Http\Controllers\Assistance;

use Histoweb\Http\Requests\OrderProcedure\CreateRequest;
use Histoweb\Http\Requests\OrderProcedure\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Entry;
use Histoweb\Entities\Procedure;
use Histoweb\Entities\ProcedureType;
use Histoweb\Entities\OrderProcedure;
use Histoweb\Entities\Formulate;

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class OrderProceduresController extends Controller {

	private $order_procedure;
	private $entry;
	private $procedure;
	private $procedure_type;
	private static $prefixRoute = 'assistance.options.order-procedures.';
	private static $prefixView = 'dashboard.pages.assistance.order-procedure.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findGroup', ['only' => ['create','store']]);
	}


	public function findGroup(Route $route)
	{
		$this->entry = Entry::findOrFail($route->getParameter('one'));
		$this->procedure = Procedure::allLists();
		$this->procedure_type = ProcedureType::allLists();
	}

	public function create()
	{
        $form_data = ['route' => [self::$prefixRoute . 'store',$this->entry->id], 'method' => 'POST', 'id' => 'entryForm'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['procedure' => $this->procedure,
        			'procedure_type' => $this->procedure_type,
        			'entry' => $this->entry]);
	}


    public function store(CreateRequest $request,$id)
    {
    	$rta = Procedure::getProceduresAll(array_map('intval', $request->get('procedure_id')));
    	$this->pdf($rta);
    	foreach ($rta as $key => $value) {
    		$value->entry_id = $this->entry->id;
    		OrderProcedure::create(json_decode($value, true));
    	}
        return redirect()->route('assistance.entries.options', $id);
    }

    public function jsonProcedure($ids)
    {
    	$rta = Procedure::getProcedures(array_map('intval', explode(',', $ids)));
    	return response($rta);
    }

    public function pdf($rta)
    {
    	return "asds";
	$patientcc = $this->entry->diary->patient->doc_type_doc;
	$patientname = $this->entry->diary->patient->name;
	$patientdoc = $this->entry->diary->patient->doc;

	$pdf = new Pdf;

	$pdf->SetTitle('Reporte');
	$pdf->SetAuthor('Histoweb');
	$pdf->SetTitle('Lista de Procedimientos, Paciente '.$patientcc .' - '. $patientname);

	foreach ($rta as $key => $value) {
	$value->entry_id = $this->entry->id;
	$proc = Procedure::findOrFail($value->procedure_id);
	$proceduretypename = $proc->procedure_type_name;
	$procedurename = $proc->name;

	$pdf->AddPage();
	$pdf->Ln(20);
	$pdf->SetFont('helvetica', 'B', 17);
	$pdf->MultiCell(0, 0, 'Lista de Procedimientos, Paciente '.$patientcc .' - '. $patientname, 0, 'C', 0, 1, '', '', true, 0);
	$pdf->Ln(10);
	$pdf->SetFont('times', '', 14);
	$pdf->Write(0, 'Tipo de Procedimiento : '.$proceduretypename, '', 0, '', 0, 0, false, false, 0);
	$pdf->SetFont('times', '', 12);
	$pdf->Ln(10);
	$pdf->Write(0, 'Procedimiento : '.$procedurename, '', 0, '', 0, 0, false, false, 0);
	}
	//$filename = public_path() . '/documents/'.$this->entry->diary->patient->doc.'-'.$valor->id.'.pdf';
	$filename = public_path() . '/documents/'.$this->entry->id.'.pdf';
	$pdf->Output($filename,'F');
    }
}
