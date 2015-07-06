<?php namespace Histoweb\Http\Controllers\Admin\System\Medicament;

use Histoweb\Http\Requests\Unit\CreateRequest;
use Histoweb\Http\Requests\Unit\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Unit;	

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class UnitsController extends Controller {

	private $unit;
	private static $prefixRoute = 'admin.system.medicament.units.';
	private static $prefixView = 'dashboard.pages.admin.system.medicament.unit.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findProcedures', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findProcedures(Route $route)
	{
		$this->unit = Unit::findOrFail($route->getParameter('units'));
	}



	public function index()
	{
        $units = Unit::orderBy('updated_at', 'desc')->paginate(12);
        return view(self::$prefixView . 'lists', compact('units'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->unit = new Unit;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['unit' => $this->unit]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->unit = Unit::create($request->all());

        if($request->ajax())
        {
            return $this->unit;
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
        $unit = Unit::find($id);
        return view(self::$prefixView . 'show',compact('id', 'unit'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->unit->id], 'method' => 'PUT'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['unit' => $this->unit]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->unit->fill($request->all());
        $this->unit->save();
        
        if($request->ajax())
        {
            return $this->unit;
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
