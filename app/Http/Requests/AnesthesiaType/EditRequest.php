<?php namespace Histoweb\Http\Requests\AnesthesiaType;

use Histoweb\Http\Requests\Request;
use Illuminate\Routing\Route;

class EditRequest extends Request {

	/**
	 * @var Route
	 */
	private $route;

	public function __construct(Route $route) 
	{
		$this->route = $route;
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
		return [
			'name'  => 'required|max:100|unique:anesthesia_types,name,' . $this->route->getParameter('anesthesiaTypes'),
            'code'  => 'required',

		];
	}

}
