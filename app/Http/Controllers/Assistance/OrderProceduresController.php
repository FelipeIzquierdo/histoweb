<?php namespace Histoweb\Http\Controllers\Assistance;

use Histoweb\Components\Pdf\PdfBuilder as MyPdf;
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
		$this->order_procedure = Procedure::getProceduresNotIn($route->getParameter('one'));
		$this->procedure = Procedure::allLists();
		$this->procedure_type = ProcedureType::allLists();
	}

	public function create()
	{
        $form_data = route(self::$prefixRoute . 'store',$this->entry->id);
        $method = 'POST';

        return view(self::$prefixView . 'form', compact('form_data','method'))
        	->with(['before_url'             => route('assistance.entries.options', $this->entry->id),
                    'procedure'              => $this->order_procedure,
        			'procedure_type'         => $this->procedure_type,
        			'entry'                  => $this->entry ]);
	}


    public function store(CreateRequest $request,$id)
    {
    	$rta = Procedure::getProceduresAll(array_map('intval', $request->get('procedure_id')),$id);
        $pdf = new MyPdf();
        $pdf->orderProceduresPdf($rta,$this->entry);
    	$rta = Procedure::getProceduresInsert(array_map('intval', $request->get('procedure_id')));
    	foreach ($rta as $key => $value) {
    		$value->entry_id = $this->entry->id;
    		OrderProcedure::create(json_decode($value, true));
    	}

        return response()->json([
                'url_options'     =>      route('assistance.entries.options', $this->entry->id),
            ]);
    }

    public function jsonProcedure($ids_procedures)
    {
    	$rta = Procedure::getProcedures(array_map('intval', explode(',', $ids_procedures)));
    	return response($rta);
    }


}
