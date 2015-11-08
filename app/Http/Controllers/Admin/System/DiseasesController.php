<?php namespace Histoweb\Http\Controllers\Admin\System;

use Histoweb\Http\Requests\Disease\CreateRequest;
use Histoweb\Http\Requests\Disease\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Disease;	

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class DiseasesController extends Controller {

	private $diseases;
	private static $prefixRoute = 'admin.system.diseases.';
	private static $prefixView = 'dashboard.pages.admin.system.disease.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findDiagnoses', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findDiagnoses(Route $route)
	{
		$this->diseases = Disease::findOrFail($route->getParameter('diseases'));
	}



	public function index()
	{
        $diseases = Disease::ListsViews();
        return view(self::$prefixView . 'lists', compact('diseases'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->diseases = new Disease;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['diseases' => $this->diseases]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->diseases = Disease::create($request->all());

        if($request->ajax())
        {
            return $this->diseases;
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
        $diseases = Disease::find($id);
        return view(self::$prefixView . 'show',compact('id', 'diseases'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->diseases->id], 'method' => 'PUT'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['diseases' => $this->diseases]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->diseases->fill($request->all());
        $this->diseases->save();
        
        if($request->ajax())
        {
            return $this->diseases;
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
