<?php namespace Histoweb\Http\Controllers\Admin\System\Medicament;

use Histoweb\Http\Requests\Concentration\CreateRequest;
use Histoweb\Http\Requests\Concentration\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Concentration;	

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class ConcentrationsController extends Controller {

	private $concentration;
	private static $prefixRoute = 'admin.system.medicament.concentrations.';
	private static $prefixView = 'dashboard.pages.admin.system.medicament.concentration.';

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
		$this->concentration = Concentration::findOrFail($route->getParameter('concentrations'));
	}



	public function index()
	{
        $concentrations = Concentration::orderBy('updated_at', 'desc')->paginate(12);
        return view(self::$prefixView . 'lists', compact('concentrations'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->concentration = new Concentration;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['concentration' => $this->concentration]);
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
        $concentration = Concentration::find($id);
        return view(self::$prefixView . 'show',compact('id', 'concentration'));
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
        	->with(['concentration' => $this->concentration]);
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
