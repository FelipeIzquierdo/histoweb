<?php namespace Histoweb\Entities;

use Illuminate\Database\Eloquent\Model;

class Eps extends Model
{
	protected $table = 'eps';
	protected $fillable = ['name', 'code'];

	public $timestamps = true;
	public $increments = true;
    public $errors;

    public static $pathPhoto = 'img/placeholders/photos/eps/';
    private static $defaultPhoto = 'img/placeholders/icons/eps.png';

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

    public static function allLists()
    {
        return self::lists('name', 'id')->all();
    }
}
