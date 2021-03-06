<?php namespace Histoweb\Http\Controllers\Admin\Company\Surgery;

use Histoweb\Http\Requests\Surgery\CreateRequest;
use Histoweb\Http\Requests\Surgery\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Surgery;
use Histoweb\Entities\Tool;

use Illuminate\Routing\Route;

class SurgeriesController extends Controller {

	private $surgery;
	private static $prefixRoute = 'admin.company.surgeries.';
	private static $prefixView = 'dashboard.pages.admin.company.surgery.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findSurgery', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findSurgery(Route $route)
	{
		$this->surgery = Surgery::findOrFail($route->getParameter('surgeries'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$surgeries = Surgery::paginate(12);

		return view(self::$prefixView . 'lists', compact('surgeries'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$surgery = new Surgery;
		$tools = Tool::allLists();
		$form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

		return view(self::$prefixView . 'form', compact('surgery', 'tools', 'form_data'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request)
	{
		$this->surgery = Surgery::create($request->all());
		$this->surgery->tools()->sync($request->input('tools'));
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
        $surgery = Surgery::find($id);
        return view(self::$prefixView . 'show',compact('id', 'surgery'));

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$tools = Tool::allLists();
		$form_data = ['route' => [self::$prefixRoute . 'update', $this->surgery->id], 'method' => 'PUT'];

		return view(self::$prefixView . 'form', compact('form_data', 'tools'))->with('surgery', $this->surgery);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditRequest $request, $id)
	{
        $this->surgery->fill($request->all());
        $this->surgery->save();
        $this->surgery->tools()->sync($request->input('tools'));

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
