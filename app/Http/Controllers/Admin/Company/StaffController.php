<?php namespace Histoweb\Http\Controllers\Admin\company;

use Histoweb\Entities\Profession;
use Histoweb\Http\Requests;
use Histoweb\Http\Requests\Staff\CreateRequest;
use Histoweb\Http\Requests\Staff\EditRequest;
use Histoweb\Entities\Staff;
use Illuminate\Http\Request;
use Histoweb\Http\Controllers\Controller;
use Response;
use Flash;
use Schema;
use Illuminate\Routing\Route;

class StaffController extends Controller
{


	private $staff;
	private static $prefixRoute = 'admin.company.staff.';
	private static $prefixView = 'dashboard.pages.admin.company.staff.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findStaff', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	public function findStaff(Route $route)
	{
		$this->staff = Staff::findOrFail($route->getParameter('staff'));
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

		$staff = Staff::orderBy('updated_at', 'desc')->paginate(12);
        return view( self::$prefixView . 'list', compact('staff'));

        
	}

	/**
	 * Show the form for creating a new Staff.
	 *
	 * @return Response
	 */
	public function create()
	{

		$this->staff = new Staff;
        $professions = Profession::allLists();
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view( self::$prefixView . 'form', compact('form_data', 'professions'))
        	->with(['staff' => $this->staff]);		
	}

	/**
	 * Store a newly created Staff in storage.
	 *
	 * @param CreateStaffRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request)
	{
        $staff = Staff::create($request->all());
        $staff->professions()->sync($request->input('professions'));
		Flash::message('Staff saved successfully.');
		return redirect(route(self::$prefixRoute . 'index'));		
	}
	

	/**
	 * Show the form for editing the specified Staff.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(empty($this->staff))
		{
			Flash::error('Staff not found');
			return redirect(route(self::$prefixRoute . 'index'));
		}
        $professions = Profession::allLists();
		$form_data = ['route' => [self::$prefixRoute . 'update', $this->staff->id], 'method' => 'PUT', 'files' => 'true'];

		return view(self::$prefixView .'form', compact('form_data', 'professions'))->with('staff', $this->staff);
	}

	/**
	 * Update the specified Staff in storage.
	 *
	 * @param  int    $id
	 * @param CreateStaffRequest $request
	 *
	 * @return Response
	 */
	public function update($id, EditRequest $request)
	{
		if(empty($this->staff))
		{
			Flash::error('Staff not found');
			return redirect(route(self::$prefixRoute . 'index'));
		}

		$this->staff->fill($request->all());
		$this->staff->save();
        $this->staff->professions()->sync($request->input('professions'));

		Flash::message('Implementer updated successfully.');
		return redirect(route(self::$prefixRoute .'index'));
	}

	/**
	 * Remove the specified Staff from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		/** @var Staff $staff */		

		if(empty($this->staff))
		{
			Flash::error('Staff not found');
			return redirect(route(self::$prefixRoute . 'index'));
		}

		$this->staff->delete();

		Flash::message('Staff deleted successfully.');

		return redirect(route(self::$prefixRoute . 'index'));
	}
}
