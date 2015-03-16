<?php namespace Histoweb;

class Entry extends Eloquent
{
	protected $table = 'entries';
	protected $primaryKey = 'id';
	protected $fillable = ['patients_cc', 'code_regime', 'code_occupation', 'code_eps', 'height',
        'weight', 'code_membership'];

	public $timestamps = false;
	public $increments = true;
	public $errors;

    public static function generateSerial($patient_id)
    {
        return self::where('patients_cc', $patient_id)->count() + 1;
    }

    public function syncReasons($reasons, $newReasons = null)
    {
        $this->reasons()->sync($reasons);
        if (!is_null($newReasons) && !empty($newReasons)) 
        {
            $newReasons = explode(",", $newReasons);
            $this->syncNewReasons($newReasons);
        }
    }

    public function syncNewReasons($newReasons)
    {
        foreach ($newReasons as $name) {
            $newReason = new Reason(['type' => $name]);
            $this->reasons()->save($newReason);
        }
    }

    public function reasons()
    {
        return $this->belongsToMany('Reason', 'entries_reasons', 'admission_code', 'code_reason');
    }


	public function isValid($data)
    {
        $rules = [
            'patients_cc'     => 'required'
        ];
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        return false;
    }

    public function validAndSave($patient_id, $data)
    {
        $data['patients_cc'] = $patient_id;

        if ($this->isValid($data))
        {
            if (!$this->exists) {
                $data['patient_entrie_number'] = self::generateSerial($patient_id);
            }
            
            $this->fill($data);
            $this->save();
            
            return true;
        }
        
        return false;
    }

}
