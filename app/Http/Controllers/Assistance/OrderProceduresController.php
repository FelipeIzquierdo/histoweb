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

use PDF;

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

    	foreach ($rta as $key => $value) {
    		$value->entry_id = $this->entry->id;
    		$proc = Procedure::findOrFail($value->procedure_id);
    		//$this->pdf($proc);
    		OrderProcedure::create(json_decode($value, true));
    	}
		
        return redirect()->route('assistance.entries.options', $id);
    }

    public function jsonProcedure($ids)
    {
    	$rta = Procedure::getProcedures(array_map('intval', explode(',', $ids)));
    	return response($rta);
    }

    public function pdf($valor)
    {
	$html = '<h1>Solicitud de Procedimiento - HISTOWEB</h1>
	<h2>'.$this->entry->diary->patient->doc_type_doc .' - '. $this->entry->diary->patient->name .'</h2>
	Tipo de procedimiento:
	<ol>
	<li><b>'.$valor->procedure_type_name.'</b></li>
	</ol>
	Procedimiento:
	<ol>
	<li><b>'.$valor->name.'</b></li>
	</ol>';

	PDF::SetTitle('Reporte');
	PDF::SetAuthor('Histoweb');
	PDF::AddPage();
	PDF::Write(0, 'Hello World');
	//PDF::writeHTML( $html, true, false, true, false, '');
	$filename = public_path() . '/documents/'.$this->entry->diary->patient->doc.'-'.$valor->id.'.pdf';
	PDF::Output($filename,'F');
    }
}
