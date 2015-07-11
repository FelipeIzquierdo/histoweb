<?php namespace Histoweb\Http\Controllers\Admin\System\Medicament;

use Histoweb\Http\Requests\GenericMedication\CreateRequest;
use Histoweb\Http\Requests\GenericMedication\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\GenericMedication;
use Histoweb\Entities\Presentation;
use Histoweb\Entities\Unit;
use Histoweb\Entities\Diluent;
use Histoweb\Entities\Concentration;

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class GenericMedicationsController extends Controller {

	private $concentration;
	private $medicament;
	private $presentation;
	private $diluent;
	private $unit;
	private static $prefixRoute = 'admin.system.medicament.generic-medications.';
	private static $prefixView = 'dashboard.pages.admin.system.medicament.generic_medication.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findMedicament', ['only' => ['show', 'edit', 'update', 'destroy']]);
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
		$this->concentration = Concentration::where('generic_medication_id','=',$route->getParameter('generic_medications'))->first();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $generic = Concentration::orderBy('updated_at', 'desc')->paginate(12);
        return view(self::$prefixView . 'listss', compact('generic'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->medicament = new GenericMedication;

        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'formm', compact('form_data'))
        	->with(['medicament' => $this->medicament,
        			'presentation' => $this->presentation,
        			'unit' => $this->unit,
        			'diluent' => $this->diluent]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->medicament = GenericMedication::create($request->only('cod','name','description'));
        $create = $request->except('cod','name','description');
        $create['generic_medication_id'] = $this->medicament->id; 
        $this->concentration = Concentration::create($create);

        if($request->ajax())
        {
            return $this->medicament;
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
        $medicament = GenericMedication::find($id);
        return view(self::$prefixView . 'show',compact('id', 'medicament'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->concentration->generic_medication_id], 'method' => 'PUT'];
        
        return view(self::$prefixView . 'formm', compact('form_data'))
        	->with(['medicament' => $this->concentration,
        			'presentation' => $this->presentation,
        			'unit' => $this->unit,
        			'diluent' => $this->diluent]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->concentration->genericMedication->fill($request->only('cod','name','description'));
        $this->concentration->genericMedication->save();
        $edit = $request->except('cod','name','description');
        $edit['generic_medication_id'] = $this->concentration->genericMedication->id; 
        $this->concentration = $this->concentration->fill($edit);
        $this->concentration->save();

        if($request->ajax())
        {
            return $this->medicament;
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
