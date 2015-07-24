<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;


class Formulate extends Model
{
	protected $fillable = [ 'administration_route_id','entry_id', 'concentration_id','dose','interval','limit'];

    protected $table = 'formulate';
	public $timestamps = true;
	public $increments = true;
	public $errors;

    public static function allLists()
    {
        return self::get()->lists( 'id' )->all();
    }
    
    public function concentration()
    {
        return $this->belongsTo('Histoweb\Entities\Concentration','concentration_id');
    }

    public function administrationRoute()
    {
        return $this->belongsTo('Histoweb\Entities\AdministrationRoute','administration_route_id');
    }

    public function getGenericMedicationIdAttribute()
    {
        if($this->concentration)
        {
            return $this->concentration->generic_medication_id;
        }
    }

    public function getForHumansAttribute()
    {
        return $this->concentration->name . ' - ' . $this->concentration->unit_amount .' '. $this->concentration->unit_name  
        .' x '. $this->concentration->diluent_amount  .' '. $this->concentration->diluent_name . ' - vía ' . $this->administrationRoute->name
        .', Tomar ' . $this->dose . ' ' . $this->presentation_name . ' cada ' .  $this->interval . ' horas durante ' .  $this->limit . ' días.';
    }
    
}
