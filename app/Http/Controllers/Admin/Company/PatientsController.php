<?php namespace Histoweb\Http\Controllers\Admin\Company;

use Histoweb\Http\Requests\Patient\CreateRequest;
use Histoweb\Http\Requests\Patient\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Patient;
use Histoweb\Entities\Occupation;
use Histoweb\Entities\DocType;

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class PatientsController extends Controller {

	private $patient;
	private $occupations;
	private $genders;
	private $doc_types;
	private static $prefixRoute = 'admin.company.patients.';
	private static $prefixView = 'dashboard.pages.admin.company.patient.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findPatient', ['only' => ['show', 'edit', 'update', 'destroy']]);
		$this->beforeFilter('@findOccupations', ['only' => ['create', 'edit']]);
		$this->beforeFilter('@findDocTypes', ['only' => ['create', 'edit']]);
		$this->genders = Patient::$genders;
	}

	/**
	 * Find all occupations
	 *
	 */
	public function findOccupations()
	{
		$this->occupations = Occupation::allLists();
	}

	/**
	 * Find all docTypes
	 *
	 */
	public function findDocTypes()
	{
		$this->doc_types = DocType::allLists();
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findPatient(Route $route)
	{
		$this->patient = Patient::findOrFail($route->getParameter('patients'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $patients = Patient::orderBy('updated_at', 'desc')->paginate(12);
        return view(self::$prefixView . 'lists', compact('patients'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->patient = new Patient;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST', 'files' => true];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['patient' => $this->patient, 'occupations' => $this->occupations, 
        		'genders' => $this->genders, 'doc_types' => $this->doc_types]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->patient = Patient::create($request->all());

        if ($photo = $request->hasFile('photo'))
		{
		    $request->file('photo')->move(Patient::$pathPhoto, $this->patient->name_photo);
		}

        if($request->ajax())
        {
            return $this->patient;
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
        $patient = Patient::find($id);
        return view(self::$prefixView . 'show',compact('id', 'patient'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->patient->id], 'method' => 'PUT', 'files' => 'true'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['patient' => $this->patient, 'occupations' => $this->occupations,
        		'genders' => $this->genders, 'doc_types' => $this->doc_types]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->patient->fill($request->all());
        $this->patient->save();
        
        if($request->ajax())
        {
            return $this->patient;
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

    public function find(Request $request, $doc){
        $patient = Patient::findByDoc($doc);
        if($patient != null){
            return $patient;
        }
    }
}
