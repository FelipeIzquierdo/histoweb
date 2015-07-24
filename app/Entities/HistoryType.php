<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class HistoryType extends Model
{
	protected $fillable = ['description', 'name', 'name_system', 'news'];
	
	public $timestamps = true;
	public $increments = true;
	public $errors;

	public static function allLists()
    {
        return self::lists('name' ,'id')->all();
    }

    public static function withHistories()
    {
    	return self::with('histories')->get();
    }

    public function histories()
    {
        return $this->hasMany('Histoweb\Entities\History');
    }

    public function historyLists()
    {
        return $this->histories->lists('name', 'id')->all();
    }

}
