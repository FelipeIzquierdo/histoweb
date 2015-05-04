<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;


class Formulate extends Model
{
	protected $fillable = [ 'limit' ,'interval','quantity', 'measure_id' ,'concentration' ,'via_medicament_id', 'presentation_id','entry_id' ,'medicament_id'];

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

    public function medicament()
    {
        return $this->belongsTo('Histoweb\Entities\Medicament', 'medicament_id');
    }

    public function getMedicamentNameAttribute()
    {
        return $this->medicament->name;   
    }

    public function viaMedicament()
    {
        return $this->belongsTo('Histoweb\Entities\viaMedicament', 'via_medicament_id');
    }

    public function getViaMedicamentNameAttribute()
    {
        return $this->viaMedicament->name;   
    }

    public function measure()
    {
        return $this->belongsTo('Histoweb\Entities\Measure', 'measure_id');
    }

    public function getMeasureNameAttribute()
    {
        return $this->measure->name;   
    }

}
