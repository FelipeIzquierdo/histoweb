<?php namespace Histoweb\Http\Controllers\Admin\System;

use App\Http\Requests;
use Histoweb\Http\Requests\Profession\CreateRequest;
use Histoweb\Http\Requests\Profession\EditRequest;
use Histoweb\Entities\Profession;
use Illuminate\Http\Request;
use Histoweb\Http\Controllers\Controller;
use Response;
use Flash;
use Illuminate\Routing\Route;

class ProfessionController extends Controller
{

	private $professions;
	private static $prefixRoute = 'admin.system.professions.';
	private static $prefixView = 'dashboard.pages.admin.system.professions.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findProfession', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	public function findProfession(Route $route)
	{
		$this->professions = Profession::findOrFail($route->getParameter('professions'));
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

		$professions = Profession::orderBy('updated_at', 'desc')->paginate(12);
        return view( self::$prefixView . 'list', compact('professions'));
		
	}

	/**
	 * Show the form for creating a new Profession.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->professions = new Profession;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view( self::$prefixView . 'form', compact('form_data'))
        	->with(['profession' => $this->professions]);	
		
	}

	/**
	 * Store a newly created Profession in storage.
	 *
	 * @param CreateProfessionRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request)
	{        

		$profession = Profession::create($request->all());

		Flash::message('Profession saved successfully.');

		return redirect(route(self::$prefixRoute . 'index'));
	}

	/**
	 * Display the specified Profession.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */	

	public function edit($id)
	{		

		if(empty($this->professions))
		{
			Flash::error('Profession not found');
			return redirect(route(self::$prefixRoute . 'index'));
		}

		$form_data = ['route' => [self::$prefixRoute . 'update', $this->professions->id], 'method' => 'PUT', 'files' => 'true']; 
		

		return view(self::$prefixView . 'form', compact('form_data'))->with('profession', $this->professions);
	}

	/**
	 * Update the specified Profession in storage.
	 *
	 * @param  int    $id
	 * @param CreateProfessionRequest $request
	 *
	 * @return Response
	 */
	public function update($id, EditRequest $request)
	{	

		if(empty($this->professions))
		{
			Flash::error('Profession not found');
			return redirect(route(self::$prefixRoute . 'index'));
		}

		$this->professions->fill($request->all());
		$this->professions->save();

		Flash::message('Profession updated successfully.');

		return redirect(route(self::$prefixRoute . 'index'));
	}

	/**
	 * Remove the specified Profession from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{		

		if(empty($this->professions))
		{
			Flash::error('Profession not found');
			return redirect(route(self::$prefixRoute . 'index'));
		}

		$this->professions->delete();

		Flash::message('Profession deleted successfully.');

		return redirect(route(self::$prefixRoute . 'index'));
	}
}
