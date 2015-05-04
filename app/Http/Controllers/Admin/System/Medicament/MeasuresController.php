<?php namespace Histoweb\Http\Controllers\Admin\System\Medicament;

use Histoweb\Http\Requests\Measure\CreateRequest;
use Histoweb\Http\Requests\Measure\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Measure;	

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class MeasuresController extends Controller {

	private $measure;
	private static $prefixRoute = 'admin.system.medicament.measures.';
	private static $prefixView = 'dashboard.pages.admin.system.medicament.measure.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findMeasure', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findMeasure(Route $route)
	{
		$this->measure = Measure::findOrFail($route->getParameter('measures'));
	}



	public function index()
	{
        $measures = Measure::orderBy('updated_at', 'desc')->paginate(12);
        return view(self::$prefixView . 'lists', compact('measures'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->measure = new Measure;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['measure' => $this->measure]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->measure = Measure::create($request->all());

        if($request->ajax())
        {
            return $this->measure;
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
        $measure = Measure::find($id);
        return view(self::$prefixView . 'show',compact('id', 'measure'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->measure->id], 'method' => 'PUT'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['measure' => $this->measure]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->measure->fill($request->all());
        $this->measure->save();
        
        if($request->ajax())
        {
            return $this->measure;
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
