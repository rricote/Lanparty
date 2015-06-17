<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Assistance extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'assistances';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['action', 'user_id', 'edition_id'];

    public function edition()
    {
        return $this->belongsTo('App\Edition');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
