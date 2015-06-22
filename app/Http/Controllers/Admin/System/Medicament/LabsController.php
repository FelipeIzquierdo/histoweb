<?php namespace Histoweb\Http\Controllers\Admin\System\Medicament;

use Histoweb\Http\Requests\Lab\CreateRequest;
use Histoweb\Http\Requests\Lab\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Lab;	

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class LabsController extends Controller {

	private $lab;
	private static $prefixRoute = 'admin.system.medicament.labs.';
	private static $prefixView = 'dashboard.pages.admin.system.medicament.lab.';

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
		$this->lab = Lab::findOrFail($route->getParameter('labs'));
	}



	public function index()
	{
        $labs = Lab::orderBy('updated_at', 'desc')->paginate(12);
        return view(self::$prefixView . 'lists', compact('labs'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->lab = new Lab;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['lab' => $this->lab]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->lab = Lab::create($request->all());

        if($request->ajax())
        {
            return $this->lab;
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
        $lab = Lab::find($id);
        return view(self::$prefixView . 'show',compact('id', 'lab'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->lab->id], 'method' => 'PUT'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['lab' => $this->lab]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->lab->fill($request->all());
        $this->lab->save();
        
        if($request->ajax())
        {
            return $this->lab;
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
