<?php namespace Histoweb\Http\Requests\WayEntry;

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
			'name'  => 'required|max:100|unique:way_entries,name',
			'description'  => 'required',
            'code'  => 'required'
		];
	}
}