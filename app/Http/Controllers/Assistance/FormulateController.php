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
	private static $prefixRoute = 'assistance.options.formulate.';
	private static $prefixView = 'dashboard.pages.assistance.formulate.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findFormulate', ['only' => ['edit', 'update']]);
		$this->beforeFilter('@findGroup', ['only' => ['create', 'edit']]);
		$this->beforeFilter('@findEntry', ['only' => ['create','store', 'edit','update']]);
	}


	public function findEntry(Route $route)
	{
		$this->entry = Entry::findOrFail($route->getParameter('one'));
	}

	public function findFormulate(Route $route)
	{
		$this->formulate = Formulate::findOrFail($route->getParameter('two'));
	}

	public function findGroup()
	{
		$this->administration_route = AdministrationRoute::allLists();
		$this->unit = Unit::allLists();
		$this->commercial_medication = CommercialMedication::allLists();
		$this->generic_medication = GenericMedication::allLists();
		$this->diluent = Diluent::allLists();
	}

	public function getPresentations(Route $route)
	{
		return \Response::json(GenericMedication::getPresentationMedicamentAttribute($route->getParameter('one')));
	}

	public function getAdministrationRoutes(Route $route)
	{
		return \Response::json(GenericMedication::getAdministrationRouteMedicamentAttribute($route->getParameter('one'),$route->getParameter('two')));
	}
	public function create($one)
	{
		$formulate_e = Formulate::orderBy('updated_at', 'desc')->paginate(12);

        $this->formulate = new Formulate;
        $form_data = ['route' => [self::$prefixRoute . 'store',$this->entry->id], 'method' => 'POST'];

        return view(self::$prefixView . 'formm', compact('form_data','formulate_e'))
        	->with(['formulate' => $this->formulate,
        			'commercial_medication' => $this->commercial_medication,
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
    public function store(CreateRequest $request,$id)
    {
    	$medicamento = [];
    	$val = [GenericMedication::findOrFail($request->get('generic_medication_id'))->AdministrationRoutePresentation];
        foreach ($val as $key => $value) {
          	$object = $value->whereRaw('presentation_id = ? and route_id = ?',[ $request->get('presentation_id') , $request->get('route_id') ])->first();
        	if(isset($object)){
        		$medicamento = $object;
        		break;
        	}
        }
    	
    	$dates = $request->except('presentation_id','route_id');
    	$dates['entry_id'] = $this->entry->id;
    	$dates['administration_route_presentation_id'] = $medicamento->id;
        $this->formulate = Formulate::create($dates);
		
        return redirect()->route(self::$prefixRoute . 'create', $id);
    }

	public function edit($one,$two)
	{
		$formulate_e = Formulate::orderBy('updated_at', 'desc')->paginate(12);
		
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->entry->id,$this->formulate->id], 'method' => 'POST'];
        
        return view(self::$prefixView . 'formm', compact('form_data','formulate_e'))
        	->with(['formulate' => $this->formulate,
        			'commercial_medication' => $this->commercial_medication,
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
    public function update(EditRequest $request, $id)
    {
    	$dates = $request->all();
    	$dates['entry_id'] = $this->entry->id;
        $this->formulate->fill($dates);
        $this->formulate->save();
        
        if($request->ajax())
        {
            return $this->formulate;
        }

        return redirect()->route(self::$prefixRoute . 'create',$id);
    }

}
