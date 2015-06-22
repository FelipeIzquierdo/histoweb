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
        return Profession::whereName('Instrumentador')->with('staff')
            ->first()->staff->lists('name', 'id');
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
