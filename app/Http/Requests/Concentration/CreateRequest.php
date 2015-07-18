<?php namespace Histoweb\Http\Requests\Concentration;

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
			'presentation_id'			=> 	'required|integer|exists:presentations,id',
			'unit_id'					=> 	'required|integer|exists:units,id',
            'diluent_id'				=> 	'required|integer|exists:diluents,id',
            'diluent_amount'			=>  'required|integer',
            'unit_amount'				=>  'required|integer',
		];
	}
}