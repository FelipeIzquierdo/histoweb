<?php namespace Histoweb\Http\Controllers\Admin\System;

use Histoweb\Http\Requests\Tool\CreateRequest;
use Histoweb\Http\Requests\Tool\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Tool;

use Illuminate\Routing\Route;

class ToolsController extends Controller {

	private $tool;
	private static $prefixRoute = 'admin.system.tools.';
	private static $prefixView = 'dashboard.pages.admin.system.tool.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findTool', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findTool(Route $route)
	{
		$this->tool = Tool::findOrFail($route->getParameter('tools'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tools = Tool::paginate(12);

		return view( self::$prefixView . 'lists', compact('tools'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$tool = new Tool;
		$form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

		return view(self::$prefixView . 'form', compact('tool', 'form_data'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request)
	{
		$this->tool = Tool::create($request->all());

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
		return view(self::$prefixView . 'show', compact('tool'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$form_data = ['route' => [self::$prefixRoute . 'update', $this->tool->id], 'method' => 'PUT'];

		return view(self::$prefixView . 'form', compact('form_data'))->with('tool', $this->tool);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditRequest $request, $id)
	{
        $this->tool->fill($request->all());
        $this->tool->save();

        return redirect()->route( self::$prefixRoute . 'index');
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
