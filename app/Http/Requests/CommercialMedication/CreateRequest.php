<?php namespace Histoweb\Http\Requests\CommercialMedication;

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
			'cod'		  		=> 	'required|max:50|unique:commercial_medications,cod', 
			'name'              => 	'required|max:50|unique:commercial_medications,name',
			'description'        => 'max:100',
			'generic_medication_id'	 => 	'required|integer|exists:generic_medications,id',
			'lab_id'	 => 	'required|integer|exists:labs,id',
		];
	}
}