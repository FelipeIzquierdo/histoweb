<?php namespace Histoweb;

class Reason extends Eloquent
{
	protected $table = 'reasons';
	protected $primaryKey = 'code_reason';
	protected $fillable = ['type', 'erasable'];

	public $timestamps = false;
	public $increments = true;
	public $errors;

    public function getIdAttribute()
    {
        return round($this->code_reason);
    }

    public function getnameAttribute()
    {
        return $this->type;
    }

    public static function allLists()
    {
        return self::lists('type', 'code_reason');
    }
}
