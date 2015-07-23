<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class SystemRevision extends Model
{
	protected $table = 'system_revisions';
	protected $fillable = ['name'];
    
	public $timestamps = true;
	public $increments = true;

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
    
    public static function allLists()
    {
        return self::lists('name', 'id');
    }
}
