<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacio extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notificacions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tipus','rao','destinatari','estat'];
}