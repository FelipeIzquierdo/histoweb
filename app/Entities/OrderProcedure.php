<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;


class OrderProcedure extends Model
{
	protected $fillable = [ 'entry_id' , 'procedure_id' ];

	public $timestamps = true;
	public $increments = true;
	public $errors;

    public function procedure()
    {
        return $this->belongsTo('Histoweb\Entities\Procedure');
    }

    public function getProcedureNameAttribute()
    {
    	return $this->procedure->name;	
    }

    public static function removeProcedure($entry,$id)
    {
        return self::where('entry_id','=',$entry)->where('procedure_id','=',$id)->delete();
    }

}
