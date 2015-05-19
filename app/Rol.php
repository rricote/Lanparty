<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rols';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany('App\User');
    }
}