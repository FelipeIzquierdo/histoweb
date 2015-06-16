<?php namespace Histoweb\Http\Controllers\Admin\System;

use Histoweb\Http\Requests;
use Histoweb\Http\Requests\StateWay\CreateRequest;
use Histoweb\Http\Requests\StateWay\EditRequest;
use Histoweb\Entities\StateWay;
use Illuminate\Http\Request;
use Histoweb\Http\Controllers\Controller;
use Response;
use Flash;
use Schema;
use Illuminate\Routing\Route;

class StateWayController extends Controller
{

	private $stateWay;
	private static $prefixRoute = 'admin.system.stateWays.';
	private static $prefixView = 'dashboard.pages.admin.system.stateWays.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findStateWay', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	public function findStateWay(Route $route)
	{
		$this->stateWay = StateWay::findOrFail($route->getParameter('stateWays'));
	}

	/**
	 * Display a listing of the Post.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$query = StateWay::query();
        $columns = Schema::getColumnListing('$TABLE_NAME$');
        $attributes = array();

        foreach($columns as $attribute){
            if($request[$attribute] == true)
            {
                $query->where($attribute, $request[$attribute]);
                $attributes[$attribute] =  $request[$attribute];
            }else{
                $attributes[$attribute] =  null;
            }
        };

        $stateWays = $query->get();

        return view(self::$prefixView . 'index')
            ->with('stateWays', $stateWays)
            ->with('attributes', $attributes);
	}

	/**
	 * Show the form for creating a new StateWay.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view(self::$prefixView . 'create');
	}

	/**
	 * Store a newly created StateWay in storage.
	 *
	 * @param CreateStateWayRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request)
	{
        $input = $request->all();

		$stateWay = StateWay::create($input);

		Flash::message('StateWay saved successfully.');

		return redirect(route(self::$prefixRoute . 'index'));
	}

	/**
	 * Display the specified StateWay.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		if(empty($this->stateWay))
		{
			Flash::error('StateWay not found');
			return redirect(route(self::$prefixRoute . 'index'));
		}

		return view(self::$prefixView . 'show')->with('stateWay', $this->stateWay);
	}

	/**
	 * Show the form for editing the specified StateWay.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(empty($this->stateWay))
		{
			Flash::error('StateWay not found');
			return redirect(route(self::$prefixRoute . 'index'));
		}

		return view(self::$prefixView . 'edit')->with('stateWay', $this->stateWay);
	}

	/**
	 * Update the specified StateWay in storage.
	 *
	 * @param  int    $id
	 * @param CreateStateWayRequest $request
	 *
	 * @return Response
	 */
	public function update($id, EditRequest $request)
	{
		/** @var StateWay $stateWay */		

		if(empty($this->stateWay))
		{
			Flash::error('StateWay not found');
			return redirect(route(self::$prefixRoute . 'index'));
		}

		$this->stateWay->fill($request->all());
		$this->stateWay->save();

		Flash::message('StateWay updated successfully.');

		return redirect(route(self::$prefixRoute . 'index'));
	}

	/**
	 * Remove the specified StateWay from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		if(empty($this->stateWay))
		{
			Flash::error('StateWay not found');
			return redirect(route(self::$prefixRoute . 'index'));
		}

		$this->stateWay->delete();

		Flash::message('StateWay deleted successfully.');

		return redirect(route(self::$prefixRoute . 'index'));
	}
}
