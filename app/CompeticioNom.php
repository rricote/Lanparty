<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CompeticioNom extends Model {

    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'competicio_nom';

    /**
     * Primary key of the table
     * @var string
     */
    protected $primaryKey = 'comp_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['comp_nom'];

}