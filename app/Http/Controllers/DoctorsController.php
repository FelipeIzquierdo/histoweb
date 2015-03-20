<?php namespace Histoweb\Http\Controllers;

use Histoweb\Doctor;
use Histoweb\Http\Requests;
use Histoweb\Http\Controllers\Controller;
use Histoweb\Specialty;

use Illuminate\Http\Request;

class DoctorsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $doctors = Doctor::paginate(12);

        return view('dashboard.pages.doctor.lists', compact('doctors'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $doctors = new Doctor;
        $form_data = ['route' => 'doctor.store', 'method' => 'POST'];
        $specialty=Specialty::lists('name', 'id' );



        return view('dashboard.pages.doctor.form', compact('doctors','specialty', 'form_data'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(Request $request)
    {
        $doctors = new Doctor;
        $data = $request->all();

        if($doctors->validAndSave($data))
        {
            return redirect()->route('doctor.index');
        }

        return redirect()->route('doctor.create')->withInput()->withErrors($doctors->errors);
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $doctors = Surgery::findOrFail($id);
        return view('dashboard.pages.doctors.show', compact('doctors'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $doctors = Doctor::findOrFail($id);
        $form_data = ['route' => ['doctor.update', $doctors->id], 'method' => 'PUT'];
        $specialty=Specialty::lists('name', 'id' );

        return view('dashboard.pages.doctor.form', compact('doctors','specialty', 'form_data'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(Request $request, $id)
    {
        $doctors = Doctor::findOrFail($id);
        $data = $request->all();

        if($doctors->validAndSave($data))
        {
            return redirect()->route('doctor.index');
        }

        return redirect()->route('doctor.create')->withInput()->withErrors($doctors->errors);
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
