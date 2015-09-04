<?php namespace Histoweb\Http\Controllers\Admin\System;

use Histoweb\Http\Requests\User\CreateRequest;
use Histoweb\Http\Requests\User\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\User;	
use Histoweb\Entities\Role;	

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends Controller {

	private $user;
	private $roles;
	private static $prefixRoute = 'admin.system.users.';
	private static $prefixView = 'dashboard.pages.admin.system.user.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findUser', ['only' => ['show', 'edit', 'update', 'destroy']]);
		$this->beforeFilter('@findRoles', ['only' => ['create', 'edit']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findUser(Route $route)
	{
		$this->user = User::findOrFail($route->getParameter('users'));
	}

	public function findRoles()
	{
		$this->roles = Role::allLists();
	}

	public function index()
	{
        $users = User::orderBy('updated_at', 'desc')->paginate(12);
        return view(self::$prefixView . 'lists', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->user = new User;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['user' => $this->user,
        			'roles' => $this->roles ]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
    	$data = $request->all();
    	$data['password'] = \Hash::make($data['password']);
        $this->user = User::create($data);

        if($request->ajax())
        {
            return $this->user;
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
        $user = User::find($id);
        return view(self::$prefixView . 'show',compact('id', 'user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->user->id], 'method' => 'PUT'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['user' => $this->user,
        			'roles' => $this->roles ]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->user->fill($request->all());
        $this->user->save();
        
        if($request->ajax())
        {
            return $this->user;
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
