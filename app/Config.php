<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'configs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['data_inici','email','description','direction','edition_id'];

    public function edition()
    {
        return $this->belongsTo('App\Edition');
    }

}
