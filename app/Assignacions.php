<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignacions extends Model {

    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'assignacions';

    /**
     * Primary key of the table
     * @var string
     */
    protected $primaryKey = 'ass_numero';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['usu_id', 'mot_id', 'data_assig', 'pre_id'];

}