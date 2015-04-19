<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;


class Patient extends Model
{
	protected $fillable = ['doc', 'doc_type_id', 'first_name',
        'last_name', 'sex', 'date_birth', 'tel', 'email', 'occupation_id'];

	public $timestamps = true;
	public $increments = true;
	public $errors;
    public static $genders = ['M' => 'Masculino', 'F' => 'Femenino'];

    public static function allLists()
    {
        return self::get()->lists('nameDoc' ,'id' );
    }

    public static function allActived()
    {
        return self::where('active', true)->get();
    }

    public static function  findByDoc($doc)
    {
        return self::where('doc',$doc)->first();
    }

    public function getActiveEntry()
    {
        return $this->entries()->lastActive();
    }

    public function getNameDocAttribute()
    {
        return $this->doc. ' - '.$this->first_name . ' ' . $this->last_name;
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getShortNameAttribute()
    {
        return substr($this->name, 0, 20);
    }

    public function getDocTypeDocAttribute()
    {
        return $this->docType->name . ':  ' . $this->doc;
    }

    public function getGenderAttribute()
    {
        return self::$genders[$this->sex];
    }

    public function getIconAttribute()
    {
        return 'fa fa-heart';
    }

    public function docType()
    {
        return $this->belongsTo('Histoweb\Entities\DocType', 'doc_type_id');
    }

    public function diaries()
    {
        return $this->hasMany('Histoweb\Entities\Diary');
    }

}
