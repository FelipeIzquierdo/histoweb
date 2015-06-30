<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;


class CommercialMedication extends Model
{
	protected $fillable = ['cod','name', 'description','generic_medication_id','lab_id'] ;

	public $timestamps = true;
	public $increments = true;
	public $errors;

    public static function allLists()
    {
        return self::get()->lists('name' ,'id' );
    }

    public function generic_medication()
    {
        return $this->belongsTo('Histoweb\Entities\GenericMedication', 'generic_medication_id');
    }

    public function getGenericMedicationNameAttribute()
    {
        return $this->generic_medication->name;   
    }

    public function lab()
    {
        return $this->belongsTo('Histoweb\Entities\Lab', 'lab_id');
    }

    public function getLabNameAttribute()
    {
        return $this->lab->name;   
    }

}
