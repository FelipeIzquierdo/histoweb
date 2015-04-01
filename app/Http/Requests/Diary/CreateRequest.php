<?php namespace Histoweb\Http\Requests\Diary;

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
			'patient_id'    => 	'required',
            'type_id'       =>	'required',
            'start'         =>  'required'
		];
	}
}