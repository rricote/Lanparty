<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Assistencies extends Model {

    /**
     * @property string accio
     * @property string usuaris_id
     */

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'assistencies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['accio', 'usuaris_id'];

}
