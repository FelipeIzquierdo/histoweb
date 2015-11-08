<?php namespace Histoweb\Http\Controllers\Admin\System\Medicament;

use Histoweb\Http\Requests\Concentration\CreateRequest;
use Histoweb\Http\Requests\Concentration\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\GenericMedication;
use Histoweb\Entities\Presentation;
use Histoweb\Entities\Unit;
use Histoweb\Entities\Diluent;
use Histoweb\Entities\Concentration;

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class ConcentrationsController extends Controller {

	private $concentration;
	private $generic_medication;
	private $presentation;
	private $diluent;
	private $unit;
	private static $prefixRoute = 'admin.system.medicament.concentrations.';
	private static $prefixView = 'dashboard.pages.admin.system.medicament.concentration.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findMedicament', ['only' => ['show', 'edit', 'update', 'destroy']]);
		$this->generic_medication = GenericMedication::allLists();
		$this->presentation = Presentation::allLists();
		$this->diluent = Diluent::allLists();
		$this->unit = Unit::allLists();
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findMedicament(Route $route)
	{
		$this->concentration = Concentration::find($route->getParameter('concentrations'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $concentration = Concentration::ListsViews();
        return view(self::$prefixView . 'lists', compact('concentration'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->concentration = new GenericMedication;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['concentration' => $this->concentration,
        			'generic_medications' => $this->generic_medication,
        			'presentations' => $this->presentation,
        			'units' => $this->unit,
        			'diluents' => $this->diluent]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->concentration = Concentration::create($request->all());

        if($request->ajax())
        {
            return $this->concentration;
        }
		
        return redirect()->route(self::$prefixRoute . 'index');
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $generic_medication = GenericMedication::find($id);
        return view(self::$prefixView . 'show',compact('id', 'generic_medication'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->concentration->id], 'method' => 'PUT'];
        
        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['concentration' => $this->concentration,
        			'generic_medications' => $this->generic_medication,
        			'presentations' => $this->presentation,
        			'units' => $this->unit,
        			'diluents' => $this->diluent]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->concentration->fill($request->all());
        $this->concentration->save();
        
        if($request->ajax())
        {
            return $this->concentration;
        }

        return redirect()->route(self::$prefixRoute . 'index');
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
}
