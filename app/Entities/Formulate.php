<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;


class Formulate extends Model
{
	protected $fillable = [ 'limit' ,'interval','dose', 'unit_id' , 'diluent_id' ,'concentration' , 'administration_route_presentation_id','entry_id' ,'commercial_medication_id','generic_medication_id'];

    protected $table = 'formulate';
	public $timestamps = true;
	public $increments = true;
	public $errors;

    public static function allLists()
    {
        return self::get()->lists( 'id' );
    }
    
    public function commercialMedication()
    {
        return $this->belongsTo('Histoweb\Entities\CommercialMedication', 'commercial_medication_id');
    }

    public function getCommercialMedicationNameAttribute()
    {
        return $this->commercialMedication->name;   
    }

    public function genericMedication()
    {
        return $this->belongsTo('Histoweb\Entities\GenericMedication', 'generic_medication_id');
    }

    public function getGenericMedicationNameAttribute()
    {
        return $this->genericMedication->name;   
    }

    public function getAdministrationRouteNameAttribute()
    {
        return $this->genericMedication->administration_route_name;   
    }

    public function getPresentationNameAttribute()
    {
        return $this->genericMedication->presentation_name;   
    }

    public function unit()
    {
        return $this->belongsTo('Histoweb\Entities\Unit', 'unit_id');
    }

    public function getUnitNameAttribute()
    {
        return $this->unit->name;   
    }

    public function diluent()
    {
        return $this->belongsTo('Histoweb\Entities\Diluent', 'diluent_id');
    }

    public function getDiluentNameAttribute()
    {
        return $this->diluent->name;   
    }
}
