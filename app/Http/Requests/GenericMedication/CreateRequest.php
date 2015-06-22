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
			'cod'		  => 	'required|max:50|unique:generic_medications,cod', 
			'name'              => 	'required|max:50|unique:generic_medications,name',
			'description'        => 'max:100'
		];
	}
}