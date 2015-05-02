<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Premis extends Model {

    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'premis';

    /**
     * Primary key of the table
     * @var string
     */
    protected $primaryKey = 'pre_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['pre_empresa'];

}