<?php namespace Histoweb\Http\Controllers\Admin\System\Medicament;

use Histoweb\Http\Requests\ViaMedicament\CreateRequest;
use Histoweb\Http\Requests\ViaMedicament\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\ViaMedicament;	

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class ViaMedicamentsController extends Controller {

	private $viamedicament;
	private static $prefixRoute = 'admin.system.medicament.via-medicaments.';
	private static $prefixView = 'dashboard.pages.admin.system.medicament.viamedicament.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findViaMedicament', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findViaMedicament(Route $route)
	{
		$this->viamedicament = ViaMedicament::findOrFail($route->getParameter('via_medicaments'));
	}



	public function index()
	{
        $viamedicaments = ViaMedicament::orderBy('updated_at', 'desc')->paginate(12);
        return view(self::$prefixView . 'lists', compact('viamedicaments'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->viamedicament = new ViaMedicament;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['viamedicament' => $this->viamedicament]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->viamedicament = ViaMedicament::create($request->all());

        if($request->ajax())
        {
            return $this->viamedicament;
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
        $viamedicament = ViaMedicament::find($id);
        return view(self::$prefixView . 'show',compact('id', 'viamedicament'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->viamedicament->id], 'method' => 'PUT'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['viamedicament' => $this->viamedicament]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->viamedicament->fill($request->all());
        $this->viamedicament->save();
        
        if($request->ajax())
        {
            return $this->viamedicament;
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
