<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Competicions extends Model {

    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'competicions';

    /**
     * Primary key of the table
     * @var string
     */
    protected $primaryKey = '';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['comp_id', 'usu_id', 'comp_grup_id', 'comp_grup_nom', 'comp_grup_validat'];

}