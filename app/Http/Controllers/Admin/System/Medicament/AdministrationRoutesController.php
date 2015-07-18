<?php namespace Histoweb\Http\Controllers\Admin\System\Medicament;

use Histoweb\Http\Requests\AdministrationRoute\CreateRequest;
use Histoweb\Http\Requests\AdministrationRoute\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\AdministrationRoute;
use Histoweb\Entities\Presentation;	

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class AdministrationRoutesController extends Controller {

	private $administration_route;
	private static $prefixRoute = 'admin.system.medicament.administration-routes.';
	private static $prefixView = 'dashboard.pages.admin.system.medicament.administration_route.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findAdministrationRoutes', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findAdministrationRoutes(Route $route)
	{
		$this->administration_route = AdministrationRoute::findOrFail($route->getParameter('administration_routes'));
	}

	public function index()
	{
        $administration_route = AdministrationRoute::orderBy('updated_at', 'desc')->paginate(12);
        return view(self::$prefixView . 'lists', compact('administration_route'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->administration_route = new AdministrationRoute;
        $form_data = ['administration_route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['administration_route' => $this->administration_route]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->administration_route = AdministrationRoute::create($request->all());

        if($request->ajax())
        {
            return $this->administration_route;
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
        $administration_route = AdministrationRoute::find($id);
        return view(self::$prefixView . 'show',compact('id', 'administration_route'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->administration_route->id], 'method' => 'PUT'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['administration_route' => $this->administration_route]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->administration_route->fill($request->all());
        $this->administration_route->save();
        
        if($request->ajax())
        {
            return $this->administration_route;
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
