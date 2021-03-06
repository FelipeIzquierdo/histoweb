<?php namespace Histoweb\Http\Requests\History;

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
			'name'              => 	'required|max:50|unique:histories,name',
            'type'				=> 	'required|integer|exists:history_types,id'
		];
	}
}