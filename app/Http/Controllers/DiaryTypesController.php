<?php namespace Histoweb\Http\Controllers;

use Histoweb\Http\Requests\Diary\Type\CreateRequest;
use Histoweb\Http\Requests\Diary\Type\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\DiaryType;

use Illuminate\Routing\Route;

class DiaryTypesController extends Controller {

	private $type;

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findDiaryType', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findDiaryType(Route $route)
	{
		$this->type = DiaryType::findOrFail($route->getParameter('diary_types'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $types = DiaryType::orderBy('updated_at', 'desc')->paginate(12);
        return view('dashboard.pages.diary.type.lists', compact('types'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->type = new DiaryType;
        $form_data = ['route' => 'diary-types.store', 'method' => 'POST'];

        return view('dashboard.pages.diary.type.form', compact('form_data'))
        	->with(['type' => $this->type]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->type = DiaryType::create($request->all());
		
        return redirect()->route('diary-types.index');
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $type = DiaryType::find($id);
        return view('dashboard.pages.diary.type.show',compact('id', 'type'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => ['diary-types.update', $this->type->id], 'method' => 'PUT', 'files' => 'true'];

        return view('dashboard.pages.diary.type.form', compact('form_data'))
        	->with(['type' => $this->type]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->type->fill($request->all());
        $this->type->save();

        return redirect()->route('diary-types.index');
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
