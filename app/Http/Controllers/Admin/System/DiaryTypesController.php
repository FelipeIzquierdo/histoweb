<?php namespace Histoweb\Http\Controllers\Admin\System;

use Histoweb\Http\Requests\Diary\Type\CreateRequest;
use Histoweb\Http\Requests\Diary\Type\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\DiaryType;

use Illuminate\Routing\Route;

class DiaryTypesController extends Controller {

	private $type;
	private static $prefixRoute = 'admin.system.diary-types.';
	private static $prefixView = 'dashboard.pages.admin.system.diary.type.';

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
        return view( self::$prefixView . 'lists', compact('types'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->type = new DiaryType;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view( self::$prefixView . 'form', compact('form_data'))
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
		
        return redirect()->route( self::$prefixRoute . 'index');
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
        return view( self::$prefixView . 'show',compact('id', 'type'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->type->id], 'method' => 'PUT', 'files' => 'true'];

        return view( self::$prefixView . 'form', compact('form_data'))
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

        return redirect()->route( self::$prefixRoute . '.index');
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
