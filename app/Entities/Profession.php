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
		"code"
	];

    public static function allLists()
    {
        return self::lists('name', 'id');
    }

    public function staff()
    {
        return $this->belongsToMany('Histoweb\Entities\Staff')->withTimestamps();
    }

	

}
