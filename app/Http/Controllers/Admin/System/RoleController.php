<?php namespace Histoweb\Http\Controllers\Admin\System;

use Histoweb\Http\Requests\Role\CreateRequest;
use Histoweb\Http\Requests\Role\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Role;	

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class RoleController extends Controller {

	private $role;
	private static $prefixRoute = 'admin.system.roles.';
	private static $prefixView = 'dashboard.pages.admin.system.role.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findRole', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findRole(Route $route)
	{
		$this->role = Role::findOrFail($route->getParameter('roles'));
	}

	public function index()
	{
        $roles = Role::orderBy('updated_at', 'desc')->paginate(12);
        return view(self::$prefixView . 'lists', compact('roles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->role = new Role;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['role' => $this->role]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->role = Role::create($request->all());

        if($request->ajax())
        {
            return $this->role;
        }
		
        return redirect()->route(self::$prefixRoute . 'index');
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $role = Role::find($id);
        return view(self::$prefixView . 'show',compact('id', 'role'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->role->id], 'method' => 'PUT'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['role' => $this->role]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->role->fill($request->all());
        $this->role->save();
        
        if($request->ajax())
        {
            return $this->role;
        }

        return redirect()->route(self::$prefixRoute . 'index');
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
