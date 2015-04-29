<?php namespace Histoweb\Http\Requests\Medicament;

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
			'name'              => 	'required|max:50|unique:medicaments,name',
			'description'        => 'required|max:100',
            'presentation_id'				=> 	'required|integer|exists:via_medicaments,id'
		];
	}
}