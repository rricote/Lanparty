<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'usuaris';

    /**
     * Primary key of the table
     * @var string
     */
    protected $primaryKey = 'usu_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['usu_dni', 'usu_nom', 'usu_cognom1', 'usu_cognom2', 'usu_nick', 'usu_correu', 'usu_pwd', 'data_registre', 'qr',  'est_id', 'rol_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['usu_pwd', 'remember_token'];

    public function getAuthPassword() {
        return md5($this->password);
    }
}