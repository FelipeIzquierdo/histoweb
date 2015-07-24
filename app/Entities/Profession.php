<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    
	public $table = "professions";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public $fillable = [
	    "name",
		"description",
		"id"
	];
    public static $codes = ['implementers' => 3];

    public static function allLists()
    {
        return self::lists('name', 'id')->all();
    }

    public static function getCode($name)
    {
        return self::$codes[$name];
    }

    public function staff()
    {
        return $this->belongsToMany('Histoweb\Entities\Staff')->withTimestamps();
    }

	

}
