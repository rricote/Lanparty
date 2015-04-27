<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Rols extends Model {

    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rols';

    /**
     * Primary key of the table
     * @var string
     */
    protected $primaryKey = 'rol_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['rol_nom'];

}