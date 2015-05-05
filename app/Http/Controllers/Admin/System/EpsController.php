<?php namespace Histoweb\Http\Controllers\Admin\System;

use Histoweb\Http\Requests\Eps\CreateRequest;
use Histoweb\Http\Requests\Eps\EditRequest;

use Histoweb\Http\Controllers\Controller;
use Histoweb\Entities\Eps;

use Illuminate\Routing\Route;

class EpsController extends Controller {

	private $eps;
	private static $prefixRoute = 'admin.system.eps.';
	private static $prefixView = 'dashboard.pages.admin.system.eps.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findEps', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findEps(Route $route)
	{
		$this->eps = Eps::findOrFail($route->getParameter('eps'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$eps = Eps::paginate(12);

		return view(self::$prefixView . 'lists', compact('eps'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$eps = new Eps;
		$form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

		return view(self::$prefixView . 'form', compact('eps', 'form_data'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request)
	{
		$this->eps = Eps::create($request->all());
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
		return view(self::$prefixView . 'show', compact('eps'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$form_data = ['route' => [self::$prefixRoute . 'update', $this->eps->id], 'method' => 'PUT'];

		return view(self::$prefixView . 'form', compact('form_data'))->with('eps', $this->eps);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditRequest $request, $id)
	{
        $this->eps->fill($request->all());
        $this->eps->save();

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
