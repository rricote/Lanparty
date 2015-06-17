<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tipus','rao','interesat','destinatari','state'];
}