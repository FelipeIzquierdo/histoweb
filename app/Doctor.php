<?php namespace Histoweb;



class Doctor extends \Eloquent
{
	protected $table = 'doctors';
	protected $primaryKey = 'id';
	public $timestamps = false;
	public $increments = true;
	public $errors;

    protected $fillable = ['cc','fist_name','last_name','specialties_id'];

    public function isValid($data)
    {
        $rules = array(
            'cc'                => 'required|max:11|unique:doctors',
            'fist_name'         => 'required',
            'last_name'         => 'required',
            'specialties_id'    => 'required'
        );

        $validator = \Validator::make($data, $rules);

        if ($validator->passes())
        {
            return true;
        }

        $this->errors = $validator->errors();
        return false;
    }

    public function validAndSave($data)
    {
        if ($this->isValid($data))
        {
            $this->fill($data);
            $this->save();
            return true;
        }
        return false;
    }
}
