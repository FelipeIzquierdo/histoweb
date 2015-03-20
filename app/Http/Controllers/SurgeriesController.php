<?php namespace Histoweb\Http\Controllers;

use Histoweb\Http\Requests;
use Histoweb\Http\Controllers\Controller;
use Histoweb\Surgery;

use Illuminate\Http\Request;

class SurgeriesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$surgeries = Surgery::paginate(12);

		return view('dashboard.pages.surgery.lists', compact('surgeries'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$surgery = new Surgery;
		$form_data = ['route' => 'consultorios.store', 'method' => 'POST'];

		return view('dashboard.pages.surgery.form', compact('surgery', 'form_data'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$surgery = new Surgery;
		$data = $request->all();

	    if($surgery->validAndSave($data))
        {
            return redirect()->route('consultorios.index');
        }

		return redirect()->route('consultorios.create')->withInput()->withErrors($surgery->errors);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$surgery = Surgery::findOrFail($id);
		
		return view('dashboard.pages.surgery.show', compact('surgery'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$surgery = Surgery::findOrFail($id);
		$form_data = ['route' => ['consultorios.update', $surgery->id], 'method' => 'PUT'];

		return view('dashboard.pages.surgery.form', compact('surgery', 'form_data'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$surgery = Surgery::findOrFail($id);
        $data = $request->all();

	    if($surgery->validAndSave($data))
        {
            return redirect()->route('consultorios.index');
        }

		return redirect()->route('consultorios.create')->withInput()->withErrors($surgery->errors);
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
