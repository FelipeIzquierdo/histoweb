<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;


class OrderProcedure extends Model
{
	protected $fillable = [ 'entry_id' , 'procedure_id' ];

	public $timestamps = true;
	public $increments = true;
	public $errors;

    public static function getListsOrderProcedures($entry_id)
    {
        return self::where('entry_id','=',$entry_id)->orderBy('updated_at', 'desc')->paginate(12);
    }
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
