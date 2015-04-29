<?php namespace Histoweb\Http\Controllers\Assistance;

use Histoweb\Http\Requests\Formulate\CreateRequest;
use Histoweb\Http\Requests\Formulate\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Formulate;
use Histoweb\Entities\Presentation;
use Histoweb\Entities\Medicament;
use Histoweb\Entities\Measure;
use Histoweb\Entities\ViaMedicament;

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class FormulateController extends Controller {

	private $formulate;
	private $presentation;
	private $medicament;
	private $measure;
	private $viamedicament;
	private static $prefixRoute = 'assistance.formulate.';
	private static $prefixView = 'dashboard.pages.assistance.formulate.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findFormulate', ['only' => ['show', 'edit', 'update', 'destroy']]);
		$this->beforeFilter('@findPresentation', ['only' => ['create', 'edit']]);
		$this->beforeFilter('@findMedicament', ['only' => ['create', 'edit']]);
		$this->beforeFilter('@findMeasure', ['only' => ['create', 'edit']]);
		$this->beforeFilter('@findViaMedicament', ['only' => ['create', 'edit']]);
	}

	public function findFormulate(Route $route)
	{
		$this->formulate = Formulate::findOrFail($route->getParameter('formulate'));
	}

	public function findViaMedicament(Route $route)
	{
		$this->viamedicament = ViaMedicament::allLists();
	}

	public function findMeasure()
	{
		$this->measure = Measure::allLists();
	}

	public function findMedicament()
	{
		$this->medicament = Medicament::allLists();
	}

	public function findPresentation()
	{
		$this->presentation = Presentation::allLists();
	}

	public function create()
	{
		$formulate_e = Formulate::orderBy('updated_at', 'desc')->paginate(12);

        $this->formulate = new Formulate;
        $form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];

        return view(self::$prefixView . 'form', compact('form_data','formulate_e'))
        	->with(['formulate' => $this->formulate,
        			'presentation' => $this->presentation,
        			'medicament' => $this->medicament,
        			'measure' => $this->measure,
        			'viamedicament' => $this->viamedicament]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {

        $this->formulate = Formulate::create($request->all());
		
        return redirect()->route(self::$prefixRoute . 'create');
    }

	public function edit($id)
	{
		$formulate_e = Formulate::orderBy('updated_at', 'desc')->paginate(12);
		
        $form_data = ['route' => [self::$prefixRoute . 'update', $this->formulate->id], 'method' => 'PUT'];

        return view(self::$prefixView . 'form', compact('form_data','formulate_e'))
        	->with(['formulate' => $this->formulate,
        			'presentation' => $this->presentation,
        			'medicament' => $this->medicament,
        			'measure' => $this->measure,
        			'viamedicament' => $this->viamedicament]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $id)
    {
        $this->formulate->fill($request->all());
        $this->formulate->save();
        
        if($request->ajax())
        {
            return $this->formulate;
        }

        return redirect()->route(self::$prefixRoute . 'create');
    }

}
