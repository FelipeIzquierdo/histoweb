<?php namespace Histoweb\Http\Controllers\Admin\System;

use Histoweb\Http\Requests;
use Histoweb\Http\Requests\Implementer\CreateRequest;
use Histoweb\Http\Requests\Implementer\EditRequest;
use Histoweb\Entities\Implementer;
use Illuminate\Http\Request;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;
use Schema;
use Illuminate\Routing\Route;

class ImplementerController extends Controller
{

	private $implementer;
	private static $prefixRoute = 'admin.system.implementers.';
	private static $prefixView = 'dashboard.pages.admin.system.implementers.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findImplementer', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	public function findImplementer(Route $route)
	{
		$this->implementer = Implementer::findOrFail($route->getParameter('implementers'));
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
		$implementers = Implementer::orderBy('updated_at', 'desc')->paginate(12);
        return view( self::$prefixView . 'list', compact('implementers'));
	}

	/**
	 * Show the form for creating a new Implementer.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->implementer = new Implementer;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view( self::$prefixView . 'form', compact('form_data'))
        	->with(['implementer' => $this->implementer]);		
	}

	/**
	 * Store a newly created Implementer in storage.
	 *
	 * @param CreateImplementerRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request)
	{      

        $input = $request->all();

		$implementer = Implementer::create($input);

		Flash::message('Implementer saved successfully.');

		return redirect(route(self::$prefixRoute . 'index'));
	}

	
	/**
	 * Show the form for editing the specified Implementer.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$form_data = ['route' => [self::$prefixRoute . 'update', $this->implementer->id], 'method' => 'PUT', 'files' => 'true'];        

		return view(self::$prefixView .'form', compact('form_data'))->with('implementer', $this->implementer);
	}

	/**
	 * Update the specified Implementer in storage.
	 *
	 * @param  int    $id
	 * @param CreateImplementerRequest $request
	 *
	 * @return Response
	 */
	public function update($id, EditRequest $request)
	{
		/** @var Implementer $implementer */
		
		$this->implementer->fill($request->all());
		$this->implementer->save();

		Flash::message('Implementer updated successfully.');

		return redirect(route(self::$prefixRoute .'index'));
	}

	/**
	 * Remove the specified Implementer from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		/** @var Implementer $implementer */
		$implementer = Implementer::find($id);

		if(empty($implementer))
		{
			Flash::error('Implementer not found');
			return redirect(route(self::$prefixRoute . 'index'));
		}

		$implementer->delete();

		Flash::message('Implementer deleted successfully.');

		return redirect(route(self::$prefixRoute . 'index'));
	}
}
