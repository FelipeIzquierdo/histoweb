<?php namespace Histoweb;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'role_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public static function allLists()
    {
        return self::lists('email', 'id' );
    }

    public function roles()
    {
        return $this->belongsTo('Histoweb\Entities\Role', 'role_id');
    }

    public function office()
    {
        return $this->morphTo();
    }

    public function doctors()
    {
        return $this->hasOne('Histoweb\Entities\Doctor','user_id');
    }

    public function patients()
    {
        return $this->hasOne('Histoweb\Entities\Patient','user_id');
    }

}
