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
            'commercial_medication_id'	=> 	'required|integer|exists:commercial_medications,id',
            'presentation_id'			=> 	'required|integer|exists:presentations,id',
            'administration_route_id'	=> 	'required|integer|exists:administration_routes,id',
            'concentration'				=>  'required|integer',
            'concentration_id'			=> 	'required|integer|exists:concentrations,id',
            'dose'						=>  'required|integer',
            'interval'					=>  'required|integer',
            'limit'						=>  'required|integer'
		];
	}
}