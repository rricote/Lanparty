<?php namespace App;

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
    protected $fillable = ['name', 'email', 'password', 'dni', 'surname1', 'surname2', 'username', 'ultratoken', 'state_id', 'rol_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function rol()
    {
        return $this->belongsTo('App\Rol');
    }

    public function competitionsusersgrups()
    {
        return $this->hasMany('App\Competitionsusersgrups');
    }

    public function assistencies()
    {
        return $this->hasMany('App\Assistencia');
    }
}
