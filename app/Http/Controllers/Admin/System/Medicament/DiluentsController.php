<?php namespace Histoweb\Http\Controllers\Admin\System\Medicament;

use Histoweb\Http\Requests\Diluent\CreateRequest;
use Histoweb\Http\Requests\Diluent\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Diluent;	

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class DiluentsController extends Controller {

	private $diluent;
	private static $prefixRoute = 'admin.system.medicament.diluents.';
	private static $prefixView = 'dashboard.pages.admin.system.medicament.diluent.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findProcedures', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findProcedures(Route $route)
	{
		$this->diluent = Diluent::findOrFail($route->getParameter('diluents'));
	}



	public function index()
	{
        $diluents = Diluent::orderBy('updated_at', 'desc')->paginate(12);
        return view(self::$prefixView . 'lists', compact('diluents'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->diluent = new Diluent;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['diluent' => $this->diluent]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
        $this->diluent = Diluent::create($request->all());

        if($request->ajax())
        {
            return $this->diluent;
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
        $diluent = Diluent::find($id);
        return view(self::$prefixView . 'show',compact('id', 'diluent'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->diluent->id], 'method' => 'PUT'];

        return view(self::$prefixView . 'form', compact('form_data'))
        	->with(['diluent' => $this->diluent]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->diluent->fill($request->all());
        $this->diluent->save();
        
        if($request->ajax())
        {
            return $this->diluent;
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
