<?php namespace Histoweb\Http\Controllers;

use Histoweb\Http\Requests\Tool\CreateRequest;
use Histoweb\Http\Requests\Tool\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Tool;

use Illuminate\Routing\Route;

class ToolsController extends Controller {

	private $tool;

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

		return view('dashboard.pages.tool.lists', compact('tools'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$tool = new Tool;
		$form_data = ['route' => 'tools.store', 'method' => 'POST'];

		return view('dashboard.pages.tool.form', compact('tool', 'form_data'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request)
	{
		$this->tool = Tool::create($request->all());

        return redirect()->route('tools.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{	
		return view('dashboard.pages.tool.show', compact('tool'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$form_data = ['route' => ['tools.update', $this->tool->id], 'method' => 'PUT'];

		return view('dashboard.pages.tool.form', compact('form_data'))->with('tool', $this->tool);
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

        return redirect()->route('tools.index');
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
