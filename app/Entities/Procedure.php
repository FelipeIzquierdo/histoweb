<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

use DB;
class Procedure extends Model {

	protected $fillable = ['cod', 'name','procedure_type_id'];

	public $timestamps = true;
	public $increments = true;

    public static function allLists()
    {
        return self::lists('name', 'id');
    }

   public function procedureType()
    {
        return $this->belongsTo('Histoweb\Entities\ProcedureType');
    }

    public function getProcedureTypeNameAttribute()
    {
    	return $this->procedureType->name;	
    }

    public static function getProcedures($ids)
    {
        $rta = self::whereIn('id',$ids)->get();
        foreach ($rta as $key => $value) {
            $rta->procedure_type_name = $value->procedure_type_name;
        }
        return $rta;
    }

    public static function getProceduresAll($ids)
    {
        return self::whereIn('id',$ids)->select('procedure_type_id', 'id as procedure_id')->get();
    }
}
