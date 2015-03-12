<?php 

class Eps extends Eloquent
{
	protected $table = 'T04EPS';
	protected $primaryKey = 'T04CodEps';
	protected $fillable = ['T04Tipo', 'T04Borrable'];

	public $timestamps = false;
	public $increments = true;
	public $errors;

    public function getIdAttribute()
    {
        return round($this->T04CodEps);
    }

    public function getnameAttribute()
    {
        return $this->T04Tipo;
    }

    public static function allLists()
    {
        return self::lists('T04Tipo', 'T04CodEps');
    }
}
