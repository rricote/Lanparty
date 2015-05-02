<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuaris extends Model {

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
    protected $fillable = ['usu_dni', 'usu_nom', 'usu_cognom1', 'usu_cognom2', 'usu_nick', 'usu_correu', 'usu_pwd', 'data_registre', 'est_id', 'rol_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['usu_pwd'];

}
