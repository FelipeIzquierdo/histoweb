<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    
	public $table = "staff";

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

    public static function allListsImplementers()
    {
        $profession = Profession::whereName('Instrumentador')->with('staff')->first();

        if($profession)
        {            
            return $profession->staff->lists('name', 'id');
        }

        return array();
        
    }

    public function professions()
    {
        return $this->belongsToMany('Histoweb\Entities\Profession')->withTimestamps();
    }

    public function getProfessionsIdAttribute()
    {
        return $this->professions->lists('id');
    }

	

}
