<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;


class Inventary extends Model
{
	protected $fillable = [ 'quantity','measure_id','concentration','medicament_id' , 'presentation_id'];

	public $timestamps = true;
	public $increments = true;
	public $errors;

    public static function allLists()
    {
        return self::get()->lists( 'id' )->all();
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

    public function measure()
    {
        return $this->belongsTo('Histoweb\Entities\Measure', 'measure_id');
    }

    public function getMeasureNameAttribute()
    {
        return $this->measure->name;   
    }
}
