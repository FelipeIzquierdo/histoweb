<?php namespace Histoweb\Http\Controllers\Admin\System;

use Histoweb\Http\Requests\Procedure\CreateRequest;
use Histoweb\Http\Requests\Procedure\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Procedure;	
use Histoweb\Entities\ProcedureType;	

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class ProceduresController extends Controller {

	private $procedure;
	private $procedure_types;
	private static $prefixRoute = 'admin.system.procedures.';
	private static $prefixView = 'dashboard.pages.admin.system.procedure.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findProcedures', ['only' => ['show', 'edit', 'update', 'destroy']]);
		$this->beforeFilter('@findProcedureTypes', ['only' => ['create', 'edit']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findProcedures(Route $route)
	{
		$this->procedure = Procedure::findOrFail($route->getParameter('procedures'));
	}

	public function findProcedureTypes()
	{
		$this->procedure_types = ProcedureType::allLists();
	}


	public function index()
	{
        $procedures = Procedure::orderBy('updated_at', 'desc')->paginate(12);
        return view(self::$prefixView . 'lists', compact('procedures'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->procedure = new Procedure;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['procedure' => $this->procedure,'procedure_types' => $this->procedure_types]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->procedure = Procedure::create($request->all());

        if($request->ajax())
        {
            return $this->procedure;
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
        $procedure = Procedure::find($id);
        return view(self::$prefixView . 'show',compact('id', 'procedure'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->procedure->id], 'method' => 'PUT'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['procedure' => $this->procedure,'procedure_types' => $this->procedure_types]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->procedure->fill($request->all());
        $this->procedure->save();
        
        if($request->ajax())
        {
            return $this->procedure;
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
