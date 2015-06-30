<?php namespace Histoweb\Http\Controllers\Admin\System\Medicament;

use Histoweb\Http\Requests\AdministrationRoute\CreateRequest;
use Histoweb\Http\Requests\AdministrationRoute\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\AdministrationRoute;
use Histoweb\Entities\Presentation;	

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class AdministrationRoutesController extends Controller {

	private $route;
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
		$this->route = AdministrationRoute::findOrFail($route->getParameter('administration_routes'));
	}

	public function index()
	{
        $route = AdministrationRoute::orderBy('updated_at', 'desc')->paginate(12);
        return view(self::$prefixView . 'lists', compact('route'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->route = new AdministrationRoute;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['route' => $this->route]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->route = AdministrationRoute::create($request->all());

        if($request->ajax())
        {
            return $this->route;
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
        $route = AdministrationRoute::find($id);
        return view(self::$prefixView . 'show',compact('id', 'route'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->route->id], 'method' => 'PUT'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['route' => $this->route]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->route->fill($request->all());
        $this->route->save();
        
        if($request->ajax())
        {
            return $this->route;
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
