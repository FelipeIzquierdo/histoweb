<?php namespace Histoweb\Http\Controllers\Admin\System\Medicament;

use Histoweb\Http\Requests\CommercialMedication\CreateRequest;
use Histoweb\Http\Requests\CommercialMedication\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\CommercialMedication;
use Histoweb\Entities\GenericMedication;
use Histoweb\Entities\Presentation;
use Histoweb\Entities\Lab;

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class CommercialMedicationsController extends Controller {

	private $medicament;
	private $generic;
	private $lab;
	private static $prefixRoute = 'admin.system.medicament.commercial-medications.';
	private static $prefixView = 'dashboard.pages.admin.system.medicament.commercial_medication.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findCommercialMedication', ['only' => ['show', 'edit', 'update', 'destroy']]);
		$this->beforeFilter('@findGenericMedication', ['only' => ['create', 'edit']]);
		$this->beforeFilter('@findLab', ['only' => ['create', 'edit']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findCommercialMedication(Route $route)
	{
		$this->medicament = CommercialMedication::findOrFail($route->getParameter('commercial_medications'));
	}

	public function findGenericMedication()
	{
		$this->generic = GenericMedication::allLists();
	}

	public function findLab()
	{
		$this->lab = Lab::allLists();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $medicament = CommercialMedication::orderBy('updated_at', 'desc')->paginate(12);
        return view(self::$prefixView . 'lists', compact('medicament'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->medicament = new CommercialMedication;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['medicament' => $this->medicament, 'generic' => $this->generic, 'lab' => $this->lab]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->medicament = CommercialMedication::create($request->all());

        if($request->ajax())
        {
            return $this->medicament;
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
        $medicament = CommercialMedication::find($id);
        return view(self::$prefixView . 'show',compact('id', 'medicament'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->medicament->id], 'method' => 'PUT'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['medicament' => $this->medicament, 'generic' => $this->generic, 'lab' => $this->lab]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->medicament->fill($request->all());
        $this->medicament->save();
        
        if($request->ajax())
        {
            return $this->medicament;
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
