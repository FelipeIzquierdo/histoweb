<?php namespace Histoweb\Http\Controllers\Assistance;

use Histoweb\Http\Requests\Formulate\CreateRequest;
use Histoweb\Http\Requests\Formulate\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Formulate;
use Histoweb\Entities\Presentation;
use Histoweb\Entities\CommercialMedication;
use Histoweb\Entities\GenericMedication;
use Histoweb\Entities\Unit;
use Histoweb\Entities\Diluent;
use Histoweb\Entities\AdministrationRoute;
use Histoweb\Entities\AdministrationRoutePresentation;
use Histoweb\Entities\Entry;
use Histoweb\Entities\Concentration;

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class FormulateController extends Controller {

	private $formulate;
	private $entry;
	private $commercial_medication;
	private $generic_medication;
	private $unit;
	private $diluent;
	private $administration_route;
	private $concentration;
	private static $prefixRoute = 'assistance.options.formulate.';
	private static $prefixView = 'dashboard.pages.assistance.formulate.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findFormulateGeneric', ['only' => ['edit']]);
		$this->beforeFilter('@findFormulate', ['only' => ['update']]);
		$this->beforeFilter('@findGroup', ['only' => ['create', 'edit']]);
		$this->beforeFilter('@findEntry', ['only' => ['create','store', 'edit','update']]);
	}


	public function findEntry(Route $route)
	{
		$this->entry = Entry::findOrFail($route->getParameter('one'));
	}

	public function findFormulateGeneric(Route $route)
	{
		$this->formulate = Formulate::findOrFail($route->getParameter('two'));
		$this->formulate['generic_medication_id'] = $this->formulate->concentration->generic_medication_id;
	}

	public function findFormulate(Route $route)
	{
		$this->formulate = Formulate::findOrFail($route->getParameter('two'));
	}

	public function findGroup()
	{
		$this->administration_route = AdministrationRoute::allLists();
		$this->unit = Unit::allLists();
		$this->generic_medication = GenericMedication::allLists();
		$this->diluent = Diluent::allLists();
		$this->concentration = Concentration::get();
	}

	public function getPresentations(Route $route)
	{
		return \Response::json(Concentration::getAllMedicamentAttribute($route->getParameter('one')));
	}

	public function create()
	{
		$formulate_e = Formulate::orderBy('updated_at', 'desc')->paginate(12);

        $this->formulate = new Formulate;
        $form_data = ['route' => [self::$prefixRoute . 'store',$this->entry->id], 'method' => 'POST'];

        return view(self::$prefixView . 'formm', compact('form_data','formulate_e'))
        	->with(['formulate' => $this->formulate,
        			'generic_medication' => $this->generic_medication,
        			'diluent' => $this->diluent,
        			'unit' => $this->unit,
        			'administration_route' => $this->administration_route,
        			'entry' => $this->entry]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
    	$create = $request->except('generic_medication_id');
    	$create['entry_id'] = $this->entry->id;
    	$this->formulate =  Formulate::create($create);
		
        return redirect()->route(self::$prefixRoute . 'create', $this->entry->id);
    }

	public function edit($one,$two)
	{
		$formulate_e = Formulate::orderBy('updated_at', 'desc')->paginate(12);
		
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->entry->id,$this->formulate->id], 'method' => 'POST'];
        
        return view(self::$prefixView . 'formm', compact('form_data','formulate_e'))
        	->with(['formulate' => $this->formulate,
        			'generic_medication' => $this->generic_medication,
        			'diluent' => $this->diluent,
        			'unit' => $this->unit,
        			'administration_route' => $this->administration_route,
        			'entry' => $this->entry]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request)
    {
    	$edit = $request->except('generic_medication_id');
    	$edit['entry_id'] = $this->entry->id;
        $this->formulate->fill($edit);
        $this->formulate->save();

        if($request->ajax())
        {
            return $this->formulate;
        }

        return redirect()->route(self::$prefixRoute . 'create',$this->entry->id);
    }

}
