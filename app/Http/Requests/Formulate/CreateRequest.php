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
            'medicament_id'				=> 	'required|integer|exists:medicaments,id',
            'presentation_id'			=> 	'required|integer|exists:presentations,id',
            'via_medicament_id'			=> 	'required|integer|exists:via_medicaments,id',
            'concentration'				=>  'required|integer',
            'measure_id'				=> 	'required|integer|exists:measures,id',
            'quantity'					=>  'required|integer',
            'interval'					=>  'required|integer',
            'limit'						=>  'required|integer'
		];
	}
}