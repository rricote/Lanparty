<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Assistencies extends Model {

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
    protected $fillable = ['name', 'email', 'password'];

}
