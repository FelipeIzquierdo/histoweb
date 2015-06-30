<?php namespace Histoweb\Http\Controllers\Admin\System;

use Histoweb\Http\Requests;
use Histoweb\Http\Requests\AnesthesiaType\CreateRequest;
use Histoweb\Http\Requests\AnesthesiaType\EditRequest;
use Histoweb\Entities\AnesthesiaType;
use Illuminate\Http\Request;
use Histoweb\Http\Controllers\Controller;
use Response;
use Flash;
use Schema;
use Illuminate\Routing\Route;

class AnesthesiaTypesController extends Controller
{

	private $anesthesiaType;
	private static $prefixRoute = 'admin.system.anesthesiaTypes.';
	private static $prefixView = 'dashboard.pages.admin.system.anesthesiaTypes.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findAnesthesiaType', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	public function findAnesthesiaType(Route $route)
	{
		$this->anesthesiaType = AnesthesiaType::findOrFail($route->getParameter('anesthesiaTypes'));
	}

	/**
	 * Display a listing of the Post.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$query = AnesthesiaType::query();
        $columns = Schema::getColumnListing('$TABLE_NAME$');
        $attributes = array();

        foreach($columns as $attribute) {
            if($request[$attribute] == true)
            {
                $query->where($attribute, $request[$attribute]);
                $attributes[$attribute] =  $request[$attribute];
            }
            else
            {
                $attributes[$attribute] =  null;
            }
        };

        $anesthesiaTypes = $query->get();

        return view(self::$prefixView . 'index')
            ->with('anesthesiaTypes', $anesthesiaTypes)
            ->with('attributes', $attributes);
	}

	/**
	 * Show the form for creating a new AnesthesiaTypes.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view(self::$prefixView . 'create');
	}

	/**
	 * Store a newly created AnesthesiaTypes in storage.
	 *
	 * @param CreateAnesthesiaTypesRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request)
	{
        $input = $request->all();

		$anesthesiaTypes = AnesthesiaType::create($input);

		Flash::message('Tipo de Anestesia  guardado correctamente.');

		return redirect(route(self::$prefixRoute . 'index'));
	}

	/**
	 * Display the specified AnesthesiaTypes.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		if(empty($this->anesthesiaType))
		{
			Flash::error('Tipo de Anestesia no encontrada');
			return redirect(route(self::$prefixRoute . 'index'));
		}

		return view(self::$prefixView .'show')->with('anesthesiaTypes', $this->anesthesiaType);
	}

	/**
	 * Show the form for editing the specified AnesthesiaTypes.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(empty($this->anesthesiaType))
		{
			Flash::error('Tipo de Anestesia no encontrada');
			return redirect(route(self::$prefixRoute . 'index'));
		}

		return view(self::$prefixView .'edit')->with('anesthesiaTypes', $this->anesthesiaType);
	}

	/**
	 * Update the specified AnesthesiaTypes in storage.
	 *
	 * @param  int    $id
	 * @param CreateAnesthesiaTypesRequest $request
	 *
	 * @return Response
	 */
	public function update($id, EditRequest $request)
	{
		/** @var AnesthesiaTypes $anesthesiaTypes */
		

		if(empty($this->anesthesiaType))
		{
			Flash::error('Tipo de Anestesia no encontrada');
			return redirect(route(self::$prefixRoute . 'index'));
		}

		$this->anesthesiaType->fill($request->all());
		$this->anesthesiaType->save();

		Flash::message('Tipo de Anestesia actualizado correctamente.');

		return redirect(route(self::$prefixRoute . 'index'));
	}

	/**
	 * Remove the specified AnesthesiaTypes from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		/** @var AnesthesiaTypes $anesthesiaTypes */
		

		if(empty($this->anesthesiaType))
		{
			Flash::error('Tipo de Anestesia no encontrada');
			return redirect(route(self::$prefixRoute . 'index'));
		}

		$this->anesthesiaType->delete();

		Flash::message('Tipo de Anestesia eliminado correctamente.');

		return redirect(route(self::$prefixRoute . 'index'));
	}
}
