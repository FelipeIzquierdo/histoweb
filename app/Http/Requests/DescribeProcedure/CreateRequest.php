<?php namespace Histoweb\Http\Requests\DescribeProcedure;

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
            "start_date"            => 'required',
            "end_date"              => 'required',
            "surgery_id"            => 'required|exists:surgeries,id',
            "doctor_id"             => 'required|exists:doctors,id',
            "anesthesia_type_id"    => 	'required|exists:anesthesia_types,id',
            "staff_id"              => 'required|exists:staff,id',
            "way_entry_id"          => 'required|exists:way_entries,id',
            "state_way_id"          => 'required|exists:state_ways,id'
		];
	}
}