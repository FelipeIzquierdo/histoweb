<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
	protected $table = 'doctors';
	protected $primaryKey = 'id';
	public $timestamps = true;
	public $increments = true;
	public $errors;
    public static $pathPhoto = 'img/placeholders/photos/doctors/';
    private static $defaultPhoto = 'img/placeholders/icons/doctor.png';

    protected $fillable = ['cc','first_name','last_name','color','specialty_id'];

    public static function allLists()
    {
        return self::get()->lists('name' ,'id' );
    }

    public function getDiariesToday()
    {
        return $this->diaries->sortBy('start')->filter(function($diary)
        {
            return $diary->isToday();
        });
    }

    public function getNameAttribute()
    {
    	return $this->first_name . ' ' . $this->last_name;
    }

    public function getNamePhotoAttribute()
    {
        return $this->id . '.jpg';
    }

    public function getPhotoAttribute()
    {
        $photo = self::$pathPhoto . $this->name_photo;
        
        if (\File::exists($photo))
        {
            return $photo;
        }

        return self::$defaultPhoto;
    }

    public function availabilities()
    {
        return $this->hasMany('Histoweb\Entities\Availability');
    }

    public function schedules()
    {
        return $this->hasMany('Histoweb\Entities\Schedule');
    }

    public function diaries()
    {
        return $this->hasMany('Histoweb\Entities\Diary');
    }

    public function specialty()
    {
        return $this->belongsTo('Histoweb\Entities\Specialty');
    }

}
