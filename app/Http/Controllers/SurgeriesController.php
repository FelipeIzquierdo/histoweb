<?php namespace Histoweb\Http\Controllers;

use Histoweb\Http\Requests\CreateSurgeryRequest;
use Histoweb\Http\Requests\EditSurgeryRequest;
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
	public function store(CreateSurgeryRequest $request)
	{
		Surgery::create($request->all());
        return redirect()->route('consultorios.index');
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
	public function update(EditSurgeryRequest $request, $id)
	{
		$surgery = Surgery::findOrFail($id);
        $surgery->fill($request->all());
        $surgery->save();

        return redirect()->route('consultorios.index');
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
