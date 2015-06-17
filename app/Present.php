<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Present extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'presents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','sponsor_id','edicio_id'];

    public function sponsor()
    {
        return $this->belongsTo('App\Sponsor');
    }

    public function edicio()
    {
        return $this->belongsTo('App\Edicio');
    }
}