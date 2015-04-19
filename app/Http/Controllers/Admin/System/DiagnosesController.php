<?php namespace Histoweb\Http\Controllers\Admin\System;

use Histoweb\Http\Requests\Diagnosis\CreateRequest;
use Histoweb\Http\Requests\Diagnosis\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Diagnosis;	

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class DiagnosesController extends Controller {

	private $diagnosis;
	private static $prefixRoute = 'admin.system.diagnoses.';
	private static $prefixView = 'dashboard.pages.admin.system.diagnosis.';

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
		$this->diagnosis = Diagnosis::findOrFail($route->getParameter('diagnoses'));
	}



	public function index()
	{
        $diagnoses = Diagnosis::orderBy('updated_at', 'desc')->paginate(12);
        return view(self::$prefixView . 'lists', compact('diagnoses'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->diagnosis = new Diagnosis;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['diagnosis' => $this->diagnosis]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->diagnosis = Diagnosis::create($request->all());

        if($request->ajax())
        {
            return $this->diagnosis;
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
        $diagnosis = Diagnosis::find($id);
        return view(self::$prefixView . 'show',compact('id', 'diagnosis'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->diagnosis->id], 'method' => 'PUT'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['diagnosis' => $this->diagnosis]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->diagnosis->fill($request->all());
        $this->diagnosis->save();
        
        if($request->ajax())
        {
            return $this->diagnosis;
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
