<?php namespace Histoweb\Http\Requests\Procedure;

//use CreateRequest;
use Histoweb\Http\Requests\Request;
use Illuminate\Routing\Route;

class EditRequest extends Request {

	/**
	 * @var Route
	 */
	private $route;
	private $createRequest;

	public function __construct(Route $route) 
	{
		$this->route = $route;
		$this->createRequest = new CreateRequest;
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = $this->createRequest->rules();
		$rules['cod'] = $rules['cod'] . ',' . $this->route->getParameter('procedures');
		$rules['name'] = $rules['name'] . ',' . $this->route->getParameter('procedures');

		return $rules;
	}

}
