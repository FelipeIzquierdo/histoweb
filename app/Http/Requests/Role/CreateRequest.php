<?php namespace Histoweb\Http\Requests\Role;

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
			'name'           	 => 'required|max:100|unique:roles,name',
            'description'        => 'max:100'
		];
	}
}