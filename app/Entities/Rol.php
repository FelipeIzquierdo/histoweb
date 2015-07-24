<?php namespace Histoweb\Entities;
	/**
	* 
	*/
	class Rol extends Eloquent
	{
		protected $table = 'roles';
		public $timestamp = true;
		protected $fillable = ['name', 'description'];


	    public static function createdRoles($number_pages = 10)
	    {
	        return self::with('rolsuperior')->orderBy('updated_at', 'desc')->paginate($number_pages);
	    }

	    public function getUpdatedAtForHumansAttribute()
	    {
	       return LocalizedCarbon::instance($this->updated_at)->diffForHumans();
	    }

	    public static function allLists()
	    {
	        return self::lists('name', 'id')->all();
	    }

	    public function isValid($data)
    	{
	        $rules = [
	        	'name'			=> 'max:100|required|unique:roles',
	        	'superior'		=> 'required'
	        ];

	        if ($this->exists)
	        {
				$rules['name'] .= ',name,'.$this->id.',id';
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
?>