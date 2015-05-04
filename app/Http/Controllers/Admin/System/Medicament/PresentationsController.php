<?php namespace Histoweb\Http\Controllers\Admin\System\Medicament;

use Histoweb\Http\Requests\Presentation\CreateRequest;
use Histoweb\Http\Requests\Presentation\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Presentation;	

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class PresentationsController extends Controller {

	private $presentation;
	private static $prefixRoute = 'admin.system.medicament.presentations.';
	private static $prefixView = 'dashboard.pages.admin.system.medicament.presentation.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findProcedures', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findProcedures(Route $route)
	{
		$this->presentation = Presentation::findOrFail($route->getParameter('presentations'));
	}



	public function index()
	{
        $presentations = Presentation::orderBy('updated_at', 'desc')->paginate(12);
        return view(self::$prefixView . 'lists', compact('presentations'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->presentation = new Presentation;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['presentation' => $this->presentation]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->presentation = Presentation::create($request->all());

        if($request->ajax())
        {
            return $this->presentation;
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
        $presentation = Presentation::find($id);
        return view(self::$prefixView . 'show',compact('id', 'presentation'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->presentation->id], 'method' => 'PUT'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['presentation' => $this->presentation]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->presentation->fill($request->all());
        $this->presentation->save();
        
        if($request->ajax())
        {
            return $this->presentation;
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
