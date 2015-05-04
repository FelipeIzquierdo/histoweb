<?php namespace Histoweb\Http\Controllers\Admin\System;

use Histoweb\Http\Requests\Membership\CreateRequest;
use Histoweb\Http\Requests\Membership\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\MembershipType;	

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class MembershipsController extends Controller {

	private $membership;
	private static $prefixRoute = 'admin.system.memberships.';
	private static $prefixView = 'dashboard.pages.admin.system.membership.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findMembership', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findMembership(Route $route)
	{
		$this->membership = MembershipType::findOrFail($route->getParameter('memberships'));
	}



	public function index()
	{
        $memberships = MembershipType::orderBy('updated_at', 'desc')->paginate(12);
        return view(self::$prefixView . 'lists', compact('memberships'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->membership = new MembershipType;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['membership' => $this->membership]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->membership = MembershipType::create($request->all());

        if($request->ajax())
        {
            return $this->membership;
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
        $membership = MembershipType::find($id);
        return view(self::$prefixView . 'show',compact('id', 'membership'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->membership->id], 'method' => 'PUT'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['membership' => $this->membership]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->membership->fill($request->all());
        $this->membership->save();
        
        if($request->ajax())
        {
            return $this->membership;
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
