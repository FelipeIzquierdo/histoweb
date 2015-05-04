<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class SystemRevision extends Model
{
	protected $table = 'system_revisions';
	protected $fillable = ['name'];
    
	public $timestamps = true;
	public $increments = true;

    public static function allLists()
    {
        return self::lists('name', 'id');
    }
}
