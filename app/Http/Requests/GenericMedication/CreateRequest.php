<?php namespace Histoweb\Http\Requests\GenericMedication;

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
			'cod'						=> 	'required|max:50|unique:generic_medications,cod', 
			'name'        		    	=> 	'required|max:50|unique:generic_medications,name',
			'description'      			=>  'max:100',
			'presentation_id'			=> 	'required|integer|exists:presentations,id',
			'unit_id'					=> 	'required|integer|exists:units,id',
            'diluent_id'				=> 	'required|integer|exists:diluents,id',
            'diluent_amount'			=>  'required|integer',
            'unit_amount'				=>  'required|integer',
		];
	}
}