<?php namespace Histoweb\Http\Controllers\Admin\System;

use Histoweb\Http\Requests\History\CreateRequest;
use Histoweb\Http\Requests\History\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\History;
use Histoweb\Entities\HistoryType;

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class HistoriesController extends Controller {

	private $history;
	private $history_types;
	private static $prefixRoute = 'admin.system.histories.';
	private static $prefixView = 'dashboard.pages.admin.system.history.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findHistory', ['only' => ['show', 'edit', 'update', 'destroy']]);
		$this->beforeFilter('@findHistoryTypes', ['only' => ['create', 'edit']]);
	}

	/**
	 * Find all HistoryTypes
	 *
	 */
	public function findHistoryTypes()
	{
		$this->history_types = HistoryType::allLists();
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findHistory(Route $route)
	{
		$this->history = History::findOrFail($route->getParameter('histories'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $histories = History::orderBy('updated_at', 'desc')->paginate(12);
        return view(self::$prefixView . 'lists', compact('histories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->history = new History;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['history' => $this->history,'history_types' => $this->history_types]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->history = History::create($request->all());

        if($request->ajax())
        {
            return $this->history;
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
        $history = History::find($id);
        return view(self::$prefixView . 'show',compact('id', 'history'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->history->id], 'method' => 'PUT'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['history' => $this->history, 'history_types' => $this->history_types]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->history->fill($request->all());
        $this->history->save();
        
        if($request->ajax())
        {
            return $this->history;
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
