<?php namespace Histoweb\Http\Requests\Formulate;

use Histoweb\Http\Requests\Request;

class CreateRequest extends Request {
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
            'generic_medication_id'		=> 	'required|integer|exists:generic_medications,id',
            'concentration_id'			=> 	'required|integer|exists:concentrations,id',
            'administration_route_id'	=> 	'required|integer|exists:administration_routes,id',
            'dose'						=>  'required|integer',
            'interval'					=>  'required|integer',
            'limit'						=>  'required|integer'
		];
	}
}