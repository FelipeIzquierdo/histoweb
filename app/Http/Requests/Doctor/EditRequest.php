<?php namespace Histoweb\Http\Requests\Doctor;

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
			'cc'                => 'required|max:11|unique:doctors,cc,' . $this->route->getParameter('doctors'),
            'first_name'        => 'required',
            'last_name'         => 'required',
            'specialty_id'    => 'required'
		];
	}

}
