<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sponsors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'type', 'logo','edition_id'];

    public function present()
    {
        return $this->hasMany('App\Present');
    }

    public function edition()
    {
        return $this->belongsTo('App\Edition');
    }
}
