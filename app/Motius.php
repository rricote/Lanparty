<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Motius extends Model {

    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'motius';

    /**
     * Primary key of the table
     * @var string
     */
    protected $primaryKey = 'mot_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['mot_nom'];

}