<?php namespace Histoweb\Http\Controllers\Admin\Company\Doctor;

use Histoweb\Http\Requests\Doctor\CreateRequest;
use Histoweb\Http\Requests\Doctor\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Doctor;
use Histoweb\Entities\Specialty;

use Illuminate\Routing\Route;

class DoctorsController extends Controller {

	private $doctor;
	private $specialties;
	private static $prefixRoute = 'admin.company.doctors.';
	private static $prefixView = 'dashboard.pages.admin.company.doctor.';

	public function __construct() 
	{
		$this->beforeFilter('@findDoctor', ['only' => ['show', 'edit', 'update', 'destroy']]);
		$this->beforeFilter('@findSpecialties', ['only' => ['create', 'edit']]);
	}

	/**
	 * Find all specialties
	 *
	 */
	public function findSpecialties()
	{
		$this->specialties = Specialty::allLists();
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findDoctor(Route $route)
	{
		$this->doctor = Doctor::findOrFail($route->getParameter('doctors'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $doctors = Doctor::paginate(12);
        return view(self::$prefixView . 'lists', compact('doctors'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->doctor = new Doctor;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST', 'files' => true];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['doctor' => $this->doctor, 'specialties' => $this->specialties]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->doctor = Doctor::create($request->all());

        if ($photo = $request->hasFile('photo'))
		{
		    $request->file('photo')->move(Doctor::$pathPhoto, $this->doctor->name_photo);
		}
		
        return redirect()->route(self::$prefixRoute . 'index', $this->doctor->id);
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $doctor = Doctor::find($id);
        return view(self::$prefixView . 'show',compact('id', 'doctor'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->doctor->id], 'method' => 'PUT', 'files' => 'true'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['doctor' => $this->doctor, 'specialties' => $this->specialties]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->doctor->fill($request->all());
        $this->doctor->save();

        if ($photo = $request->hasFile('photo'))
		{
		    $request->file('photo')->move(Doctor::$pathPhoto, $this->doctor->name_photo);
		}

        return redirect()->route(self::$prefixRoute . 'index', $this->doctor->id);
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
