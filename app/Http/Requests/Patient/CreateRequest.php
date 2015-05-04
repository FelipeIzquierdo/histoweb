<?php namespace Histoweb\Http\Requests\Patient;

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
			'doc'               => 	'required|max:100|unique:patients,doc',
            'first_name'        => 	'required|max:50',
            'last_name'         => 	'required|max:50',
            'doc_type_id'		=> 	'required|integer|exists:doc_types,id',
            'occupation_id'     => 	'required|integer|exists:occupations,id',
            'date_birth'		=>	'required|date',
            'sex'				=> 	'required|in:M,F',
            'email'				=>	'email|max:100|unique:patients,email',
            'tel'				=>	'numeric',
            'address'           =>  'max:100'
		];
	}
}