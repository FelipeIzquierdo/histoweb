<?php namespace Histoweb\Http\Controllers\Admin\System\Medicament;

use Histoweb\Http\Requests\GenericMedication\CreateRequest;
use Histoweb\Http\Requests\GenericMedication\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\GenericMedication;

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class GenericMedicationsController extends Controller {

	private $generic_medication;
	private static $prefixRoute = 'admin.system.medicament.generic-medications.';
	private static $prefixView = 'dashboard.pages.admin.system.medicament.generic_medication.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findMedicament', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findMedicament(Route $route)
	{
		$this->generic_medication = GenericMedication::find($route->getParameter('generic_medications'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $generic_medication = GenericMedication::ListsViews();
        return view(self::$prefixView . 'listss', compact('generic_medication'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->generic_medication = new GenericMedication;

        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'formm', compact('form_data'))
        	->with(['generic_medication' => $this->generic_medication]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->generic_medication = GenericMedication::create($request->all());

        if($request->ajax())
        {
            return $this->generic_medication;
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
        $generic_medication = GenericMedication::find($id);
        return view(self::$prefixView . 'show',compact('id', 'generic_medication'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->generic_medication->id], 'method' => 'PUT'];
        
        return view(self::$prefixView . 'formm', compact('form_data'))
        	->with(['generic_medication' => $this->generic_medication]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->generic_medication->fill($request->all());
        $this->generic_medication->save();
        
        if($request->ajax())
        {
            return $this->generic_medication;
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
