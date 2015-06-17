<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Motive extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'motives';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','edicio_id'];

    public function edicio()
    {
        return $this->belongsTo('App\Edicio');
    }
}