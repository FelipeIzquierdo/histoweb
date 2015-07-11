<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;
use Histoweb\Entities\Presentation;

class GenericMedication extends Model
{
	protected $fillable = ['cod','name', 'description'] ;

	public $timestamps = true;
	public $increments = true;
	public $errors;

    public static function allLists()
    {
        return self::get()->lists('name' ,'id' );
    }

  /*  public static function getPresentationMedicamentAttribute($medicament)
    {
        $val = [self::find($medicament)];
        foreach ($val as $key => $value) {
            $val[$key]->presentation = $value->presentation; 
        }
        return $val;
    }
    */
}