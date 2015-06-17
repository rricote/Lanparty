<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'assignments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'motive_id', 'present_id', 'edition_id'];

    public function edition()
    {
        return $this->belongsTo('App\Edition');
    }
}