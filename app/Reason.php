<?php 

class Reason extends Eloquent
{
	protected $table = 'T15MOTIVODECONSULTA';
	protected $primaryKey = 'T15CodMotivoConsulta';
	protected $fillable = ['T15Tipo', 'T15Borrable'];

	public $timestamps = false;
	public $increments = true;
	public $errors;

    public function getIdAttribute()
    {
        return round($this->T15CodMotivoConsulta);
    }

    public function getnameAttribute()
    {
        return $this->T15Tipo;
    }

    public static function allLists()
    {
        return self::lists('T15Tipo', 'T15CodMotivoConsulta');
    }
}
