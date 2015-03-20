<?php namespace Histoweb;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Surgery extends Model {

	protected $fillable = ['name'];

	public function isValid($data)
    {
        $rules = array(
            'name'     => 'required|max:100|unique:surgeries'
        );

        if ($this->exists)
        {
			$rules['name'] .= ',name,'.$this->id;
        }
        
        $validator = Validator::make($data, $rules);
        
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
