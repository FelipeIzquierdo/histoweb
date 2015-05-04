<?php namespace Histoweb\Http\Controllers\Admin\System;

use Histoweb\Http\Requests\SystemRevision\CreateRequest;
use Histoweb\Http\Requests\SystemRevision\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\SystemRevision;	

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class SystemRevisionsController extends Controller {

	private $revision;
	private static $prefixRoute = 'admin.system.system-revisions.';
	private static $prefixView = 'dashboard.pages.admin.system.systemrevision.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findSystemRevisions', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findSystemRevisions(Route $route)
	{
		$this->revision = SystemRevision::findOrFail($route->getParameter('system_revisions'));
	}



	public function index()
	{
        $revisions = SystemRevision::orderBy('updated_at', 'desc')->paginate(12);
        return view(self::$prefixView . 'lists', compact('revisions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->revision = new SystemRevision;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['revision' => $this->revision]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->revision = SystemRevision::create($request->all());

        if($request->ajax())
        {
            return $this->revision;
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
        $revision = SystemRevision::find($id);
        return view(self::$prefixView . 'show',compact('id', 'revision'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->revision->id], 'method' => 'PUT'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['revision' => $this->revision]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->revision->fill($request->all());
        $this->revision->save();
        
        if($request->ajax())
        {
            return $this->revision;
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
