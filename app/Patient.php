<?php 

class Patient extends Eloquent
{
	protected $table = 'T31IDENTIFICACION';
	protected $primaryKey = 'T31CC';
	protected $fillable = ['T31CC', 'T31CodTipoDocId', 'T31Nombre', 'T31SegundoNombre', 'T31PrimerApellido', 
        'T31SegundoApellido', 'T31Sexo', 'T31Activo', 'T32FechaNacimiento'];

	public $timestamps = false;
	public $increments = false;
	public $errors;

    public static function allActived()
    {
        return self::where('T31Activo', true)->get();
    }

    public function getIdAttribute()
    {
        return round($this->T31CC);
    }

    public function getSexAttribute()
    {
        return $this->T31Sexo;
    }

    public function getDocTypeIdAttribute()
    {
        return $this->T31CodTipoDocId;
    }

    public function getDocTypeTextAttribute()
    {
        return $this->docType->T023Tipo;
    }

    public function getNameAttribute()
    {
        return $this->T31Nombre . ' ' . $this->T31SegundoNombre . ' ' . $this->T31PrimerApellido . ' ' . $this->T31SegundoApellido;
    }

    public function docType()
    {
        return $this->belongsTo('DocType', 'T31CodTipoDocId');
    }

    public function entries()
    {
        return $this->hasMany('Entry', 'T32CC');
    }

    public function output()
    {
        $this->T31Activo = false;
        $this->save();
    }

    public function isActived()
    {
        if($this->T31Activo)
        {
            return true;
        }

        return false;
    }

    public function getLastActiveEntry()
    {
        if($this->isActived())
        {
            return $this->entries()->orderBy('T32ConsecIngreso', 'asc')->first();
        }

        return new Entry;
    }

    public function getLastEntry()
    {
        if($this->exists)
        {
            return $this->entries()->orderBy('T32ConsecIngreso', 'asc')->first();
        }

        return new Entry;
    }

    public function getLastEntryAttribute()
    {
        return $this->getLastEntry();
    }

    public function getLastReasonsListsAttribute()
    {
        return $this->getLastEntry()->reasons->lists('T15CodMotivoConsulta');
    }

    public function syncLastReasons($reasons, $newReasons = null)
    {
        $this->getLastEntry()->syncReasons($reasons, $newReasons);
    }

	public function isValid($data)
    {
        $rules = array(
            'T31CC'     => 'required|max:100|unique:T31IDENTIFICACION',
            'T31CodTipoDocId' => 'required'
        );

        if ($this->exists)
        {
			$rules['T31CC'] .= ',T31CC,'.$this->id.',T31CC';
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
