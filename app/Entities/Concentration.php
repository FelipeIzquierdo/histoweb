<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;
use Histoweb\Entities\Presentation;

class Concentration extends Model
{
	protected $fillable = [ 'diluent_amount' ,'unit_amount', 'unit_id' , 'presentation_id' ,'diluent_id' , 'generic_medication_id'];

	public $timestamps = true;
	public $increments = true;
	public $errors;

    public static function ListsViews()
    {
        return self::orderBy('updated_at', 'desc')->paginate(12);
    }

    public static function getAllList($medicament)
    {
        return self::whereGenericMedicationId($medicament)
            ->with(['presentation', 'unit', 'diluent'])
            ->get()->lists('detail', 'id')->all();
    }

    public function getDetailAttribute()
    {
        return $this->presentation->name . ' > ' . $this->unit_amount . ' ' . $this->unit->name 
            . ' en ' . $this->diluent_amount . ' ' . $this->diluent->name;
    }

    public function presentation()
    {
        return $this->belongsTo('Histoweb\Entities\Presentation', 'presentation_id');
    }

    public function getPresentationNameAttribute()
    {
        return $this->presentation->name;
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

    public function genericMedication()
    {
        return $this->belongsTo('Histoweb\Entities\GenericMedication', 'generic_medication_id');
    }

    public function getCodAttribute()
    {
        return $this->genericMedication['cod'];
    }

    public function getNameAttribute()
    {
        return $this->genericMedication['name'];
    }

    public function getDescriptionAttribute()
    {
        return $this->genericMedication['description'];
    }
}