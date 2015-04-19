<?php namespace Histoweb\Http\Controllers\Admin\System;

use Histoweb\Http\Requests\Reason\CreateRequest;
use Histoweb\Http\Requests\Reason\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Reason;	

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class ReasonsController extends Controller {

	private $reason;
	private static $prefixRoute = 'admin.system.reasons.';
	private static $prefixView = 'dashboard.pages.admin.system.reason.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findReasons', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findReasons(Route $route)
	{
		$this->reason = Reason::findOrFail($route->getParameter('reasons'));
	}



	public function index()
	{
        $reasons = Reason::orderBy('updated_at', 'desc')->paginate(12);
        return view(self::$prefixView . 'lists', compact('reasons'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->reason = new Reason;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['reason' => $this->reason]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->reason = Reason::create($request->all());

        if($request->ajax())
        {
            return $this->reason;
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
        $reason = Reason::find($id);
        return view(self::$prefixView . 'show',compact('id', 'reason'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->reason->id], 'method' => 'PUT'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['reason' => $this->reason]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->reason->fill($request->all());
        $this->reason->save();
        
        if($request->ajax())
        {
            return $this->reason;
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
