<?php namespace Histoweb\Http\Controllers\Admin\System\Medicament;

use Histoweb\Http\Requests\GenericMedication\CreateRequest;
use Histoweb\Http\Requests\GenericMedication\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\GenericMedication;
use Histoweb\Entities\Presentation;
use Histoweb\Entities\AdministrationRoute;
use Histoweb\Entities\AdministrationRoutePresentation;

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class GenericMedicationsController extends Controller {

	private $medicament;
	private $presentation;
	private $route;
	private static $prefixRoute = 'admin.system.medicament.generic-medications.';
	private static $prefixView = 'dashboard.pages.admin.system.medicament.generic_medication.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findMedicament', ['only' => ['show', 'edit', 'update', 'destroy']]);
		$this->presentation = Presentation::allLists();
		$this->route = AdministrationRoute::allLists();
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findMedicament(Route $route)
	{
		$this->medicament = GenericMedication::findOrFail($route->getParameter('generic_medications'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $generic = GenericMedication::orderBy('updated_at', 'desc')->paginate(12);
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
        			'route' => $this->route]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
    	$id = AdministrationRoutePresentation::create($request->only('presentation_id','route_id'));
    	$value = $request->except('presentation_id','route_id');
    	$value['administration_route_presentation_id'] = $id->id;
        $this->medicament = GenericMedication::create($value);

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
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->medicament->id], 'method' => 'PUT'];
        
        return view(self::$prefixView . 'formm', compact('form_data'))
        	->with(['medicament' => $this->medicament,
        			'presentation' => $this->presentation,
        			'route' => $this->route]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
    	$this->medicament->AdministrationRoutePresentation->fill($request->only('presentation_id','route_id'));
    	$this->medicament->AdministrationRoutePresentation->save();
    	$value = $request->except('presentation_id','route_id');
    	$value['administration_route_presentation_id'] = $this->medicament->AdministrationRoutePresentation->id;
        $this->medicament->fill($value);
        $this->medicament->save();
        
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
