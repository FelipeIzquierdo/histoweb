<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;


class Formulate extends Model
{
	protected $fillable = [ 'limit' ,'interval','dose', 'concentration_id' ,'concentration' ,'administration_route_id', 'presentation_id','entry_id' ,'commercial_medication_id'];

    protected $table = 'formulate';
	public $timestamps = true;
	public $increments = true;
	public $errors;

    public static function allLists()
    {
        return self::get()->lists( 'id' );
    }

    public function presentation()
    {
        return $this->belongsTo('Histoweb\Entities\Presentation', 'presentation_id');
    }

    public function getPresentationNameAttribute()
    {
        return $this->presentation->name;   
    }

    public function commercialMedication()
    {
        return $this->belongsTo('Histoweb\Entities\CommercialMedication', 'commercial_medication_id');
    }

    public function getCommercialMedicationNameAttribute()
    {
        return $this->commercialMedication->name;   
    }

    public function AdministrationRoute()
    {
        return $this->belongsTo('Histoweb\Entities\AdministrationRoute', 'administration_route_id');
    }

    public function getAdministrationRouteNameAttribute()
    {
        return $this->AdministrationRoute->name;   
    }

    public function Concentration()
    {
        return $this->belongsTo('Histoweb\Entities\Concentration', 'concentration_id');
    }

    public function getConcentrationNameAttribute()
    {
        return $this->Concentration->name;   
    }

}
