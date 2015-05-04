<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;


class OrderProcedure extends Model
{
	protected $fillable = [ 'entry_id' , 'procedure_type_id', 'procedure_id' ];

	public $timestamps = true;
	public $increments = true;
	public $errors;

   	public function procedureType()
    {
        return $this->belongsTo('Histoweb\Entities\ProcedureType');
    }

    public function getProcedureTypeNameAttribute()
    {
    	return $this->procedureType->name;	
    }

   public function procedure()
    {
        return $this->belongsTo('Histoweb\Entities\Procedure');
    }

    public function getProcedureNameAttribute()
    {
    	return $this->procedure->name;	
    }

}
