<?php namespace Histoweb\Http\Requests\History\Type;

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
			'name'              => 	'required|max:250|unique:history_types,name',
			'name_system'       => 	'required|max:250|unique:history_types,name_system',
            'description'		=>	'min:15'
		];
	}
}