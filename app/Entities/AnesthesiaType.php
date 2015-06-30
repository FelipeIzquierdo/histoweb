<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class AnesthesiaType extends Model
{
    
	public $table = "anesthesia_types";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public $fillable = [
	    "name",
		"description",
		"code"
	];

    public static function allLists()
    {
        return self::lists('name', 'id' );
    }

	

}
