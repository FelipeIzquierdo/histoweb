<?php namespace Histoweb\Http\Controllers\Admin\System\Medicament;

use Histoweb\Http\Requests\Inventary\CreateRequest;
use Histoweb\Http\Requests\Inventary\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Inventary;
use Histoweb\Entities\Presentation;
use Histoweb\Entities\Medicament;
use Histoweb\Entities\Measure;

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class InventariesController extends Controller {

	private $inventary;
	private $presentation;
	private $medicament;
	private $measure;
	private static $prefixRoute = 'admin.system.medicament.inventaries.';
	private static $prefixView = 'dashboard.pages.admin.system.medicament.inventary.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findInventary', ['only' => ['show', 'edit', 'update', 'destroy']]);
		$this->beforeFilter('@findPresentation', ['only' => ['create', 'edit']]);
		$this->beforeFilter('@findMedicament', ['only' => ['create', 'edit']]);
		$this->beforeFilter('@findMeasure', ['only' => ['create', 'edit']]);
	}

	public function findMeasure()
	{
		$this->measure = Measure::allLists();
	}

	public function findMedicament()
	{
		$this->medicament = Medicament::allLists();
	}

	public function findPresentation()
	{
		$this->presentation = Presentation::allLists();
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findInventary(Route $route)
	{
		$this->inventary = Inventary::findOrFail($route->getParameter('inventaries'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $inventaries = Inventary::orderBy('updated_at', 'desc')->paginate(12);
        return view(self::$prefixView . 'lists', compact('inventaries'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->inventary = new Inventary;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['inventary' => $this->inventary,
        			'presentation' => $this->presentation,
        			'medicament' => $this->medicament,
        			'measure' => $this->measure]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {

        $this->inventary = Inventary::create($request->all());

        if($request->ajax())
        {
            return $this->inventary;
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
        $inventary = Inventary::find($id);
        return view(self::$prefixView . 'show',compact('id', 'inventary'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->inventary->id], 'method' => 'PUT'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['inventary' => $this->inventary,
        			'presentation' => $this->presentation,
        			'medicament' => $this->medicament,
        			'measure' => $this->measure]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->inventary->fill($request->all());
        $this->inventary->save();
        
        if($request->ajax())
        {
            return $this->inventary;
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
