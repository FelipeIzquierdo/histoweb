<?php namespace Histoweb\Entities;

class Patient extends Eloquent
{
	protected $table = 'patients';
	protected $primaryKey = 'cc';
	protected $fillable = ['cc', 'doc_type_id', 'first_name',
        'last_name', 'sex', 'active', 'date_birth'];

	public $timestamps = false;
	public $increments = false;
	public $errors;

    public static function allActived()
    {
        return self::where('active', true)->get();
    }

    public function getIdAttribute()
    {
        return round($this->cc);
    }

    public function getSexAttribute()
    {
        return $this->sex;
    }

    public function getDocTypeIdAttribute()
    {
        return $this->doc_type_id;
    }

    public function getDocTypeTextAttribute()
    {
        return $this->docType->type;
    }

    public function getNameAttribute()
    {
        return $this->name . ' ' . $this->middle_name . ' ' . $this->surname . ' ' . $this->last_name;
    }

    public function docType()
    {
        return $this->belongsTo('DocType', 'doc_type_id');
    }

    public function entries()
    {
        return $this->hasMany('Entry', 'patients_cc');
    }

    public function output()
    {
        $this->active = false;
        $this->save();
    }

    public function isActived()
    {
        if($this->active)
        {
            return true;
        }

        return false;
    }

    public function getLastActiveEntry()
    {
        if($this->isActived())
        {
            return $this->entries()->orderBy('patient_entry_number', 'asc')->first();
        }

        return new Entry;
    }

    public function getLastEntry()
    {
        if($this->exists)
        {
            return $this->entries()->orderBy('patient_entry_number', 'asc')->first();
        }

        return new Entry;
    }

    public function getLastEntryAttribute()
    {
        return $this->getLastEntry();
    }

    public function getLastReasonsListsAttribute()
    {
        return $this->getLastEntry()->reasons->lists('code_reason');
    }

    public function syncLastReasons($reasons, $newReasons = null)
    {
        $this->getLastEntry()->syncReasons($reasons, $newReasons);
    }

	public function isValid($data)
    {
        $rules = array(
            'cc'     => 'required|max:100|unique:patients',
            'doc_type_id' => 'required'
        );

        if ($this->exists)
        {
			$rules['cc'] .= ',cc,'.$this->id.',cc';
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
