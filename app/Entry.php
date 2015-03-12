<?php 

class Entry extends Eloquent
{
	protected $table = 'T32INGRESOSPORPERSONA';
	protected $primaryKey = 'T32Id';
	protected $fillable = ['T32CC', 'T32ConsecIngreso', 'T32CodRegimen', 'T32CodOcupacion', 'T32CodEps', 'T32TallaenCms', 
        'T32PesoenKilos', 'T32CodTipoAfiliacion'];

	public $timestamps = false;
	public $increments = true;
	public $errors;

    public static function generateSerial($patient_id)
    {
        return self::where('T32CC', $patient_id)->count() + 1;
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
            $newReason = new Reason(['T15Tipo' => $name]);
            $this->reasons()->save($newReason);
        }
    }

    public function reasons()
    {
        return $this->belongsToMany('Reason', 'T34MOTIVODECONSULTAXPNA', 'T34CodIngreso', 'T34CodMotivoConsulta');
    }


	public function isValid($data)
    {
        $rules = [
            'T32CC'     => 'required'
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
        $data['T32CC'] = $patient_id;

        if ($this->isValid($data))
        {
            if (!$this->exists) {
                $data['T32ConsecIngreso'] = self::generateSerial($patient_id);
            }
            
            $this->fill($data);
            $this->save();
            
            return true;
        }
        
        return false;
    }

}
