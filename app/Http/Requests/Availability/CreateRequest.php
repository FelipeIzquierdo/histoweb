<?php namespace Histoweb\Http\Requests\Availability;

use Histoweb\Http\Requests\Request;
use Illuminate\Routing\Route;

class CreateRequest extends Request {
	
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
			'start_date' => 'required',
			'end_date' => 'required',
			'days' => 'required',
			'start_time' => 'required',
			'end_time' => 'required'
		];
	}
}