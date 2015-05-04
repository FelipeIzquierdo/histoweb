<?php namespace Histoweb\Entities;

class Eps extends Eloquent
{
	protected $table = 'eps';
	protected $primaryKey = 'code_eps';
	protected $fillable = ['type', 'erasable'];

	public $timestamps = false;
	public $increments = true;
	public $errors;

    public function getIdAttribute()
    {
        return round($this->code_eps);
    }

    public function getnameAttribute()
    {
        return $this->type;
    }

    public static function allLists()
    {
        return self::lists('type', 'code_eps');
    }
}
