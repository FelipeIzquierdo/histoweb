<?php namespace Histoweb\Http\Requests\Doctor;

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
			'cc'                => 'required|max:11|unique:doctors,cc',
            'first_name'        => 'required',
            'last_name'         => 'required',
            'specialty_id'      => 'required',
            'photo'             => 'required',
            'user_id'			=> 'required'
		];
	}
}