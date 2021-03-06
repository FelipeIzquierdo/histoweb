<?php namespace Histoweb\Http\Requests\availability;

use Histoweb\Http\Requests\Request;
use Illuminate\Routing\Route;

class CreateMassiveRequest extends Request {
	
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
			'start' => 'required',
			'end' => 'required',
			'surgery_id' => 'required',
			'doctor_id' => 'required'

		];
	}
}