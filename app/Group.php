<?php namespace Histoweb;

class Group extends Eloquent
{
	protected $table = 'TZ2GRUPOS';
	protected $primaryKey = 'Tz2CodGrupo';
	protected $fillable = ['Tz2Nombre', 'Tz2Descripcion'];

	public $timestamps = false;
	public $increments = true;
	public $errors;

    public function getIdAttribute()
    {
        return round($this->Tz2CodGrupo);
    }

    public function getNameAttribute()
    {
        return $this->Tz2Nombre;
    }

    public function getDescriptionAttribute()
    {
        return $this->Tz2Descripcion;
    }


	public function isValid($data)
    {
        $rules = [
            'Tz2Nombre'     => 'required|max:50|unique:TZ2GRUPOS',
            'Tz2Descripcion'     => 'max:254',
        ];

        if ($this->exists)
        {
            $rules['Tz2Nombre'] .= ',Tz2Nombre,'.$this->id.',Tz2CodGrupo';
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
