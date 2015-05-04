<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Estats extends Model {

    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'estats';

    /**
     * Primary key of the table
     * @var string
     */
    protected $primaryKey = 'est_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['est_nom'];

}