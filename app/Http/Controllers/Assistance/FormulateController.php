<?php namespace Histoweb\Http\Controllers\Assistance;

use Histoweb\Http\Requests\Formulate\CreateRequest;
use Histoweb\Http\Requests\Formulate\EditRequest;
use Histoweb\Http\Controllers\Controller;

use Histoweb\Entities\Formulate;
use Histoweb\Entities\Entry;
use Histoweb\Entities\Concentration;

use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class FormulateController extends Controller {

	private $formulate;
	private $entry;

	private static $prefixRoute = 'assistance.options.formulate.';
	private static $prefixView = 'dashboard.pages.assistance.formulate.';

	public function __construct() 
	{
		$this->middleware('auth');
		$this->beforeFilter('@findEntry', ['only' => ['create','store', 'edit','update']]);
		$this->beforeFilter('@findFormulate', ['only' => ['edit', 'update']]);
	}

	public function findEntry(Route $route)
	{
		$this->entry = Entry::findOrFail($route->getParameter('one'));
	}

	public function findFormulate(Route $route)
	{
		$this->formulate = $this->entry->formulates()->findOrFail($route->getParameter('two'));
	}

	public function getPresentations(Route $route)
	{
		return \Response::json(Concentration::getAllList($route->getParameter('one')));
	}

	public function create()
	{
		$formulations = $this->entry->getFormulatePaginate();
        $this->formulate = new Formulate;
        $form_data = route(self::$prefixRoute . 'store',$this->entry->id);
        $method_form_data = 'POST';        

        return view(self::$prefixView . 'form', compact('form_data','formulations','method_form_data'))
        	->with(['formulate' 			=> $this->formulate, 'entry' => $this->entry, 
        			'before_url' 			=> route('assistance.entries.options', $this->entry->id),
        			'create_formulate_url' 	=> route('assistance.options.formulate.create', $this->entry->id) 
        			 ]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateRequest $request)
    {
    	$this->formulate = new Formulate($request->all());
    	$this->entry->formulates()->save($this->formulate);
		
		return response()->json([
                'url_formulate' 	=>   	route(self::$prefixRoute . 'create', $this->entry->id),
            ]);
    }

	public function edit($entry_id, $formulate_id)
	{
		$formulations = $this->entry->getFormulatePaginate();
        $form_data = route(self::$prefixRoute . 'update',[$this->entry->id, $formulate_id]);
        $method_form_data = 'POST';       

        return view(self::$prefixView . 'form', compact('form_data','formulations','method_form_data'))
        	->with(['formulate' 			=> $this->formulate, 'entry' => $this->entry,
        			'before_url' 			=> route('assistance.entries.options', $this->entry->id),
        			'create_formulate_url' 	=> route('assistance.options.formulate.create', $this->entry->id) 
        			]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request)
    {
        $this->formulate->fill($request->all());
        $this->formulate->save();

        return response()->json([
                'url_formulate' 	=>   	route(self::$prefixRoute . 'create', $this->entry->id),
            ]);
    }

}
