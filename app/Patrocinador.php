<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Patrocinador extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'patrocinadors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'tipus', 'logo','edicio_id'];

    public function premi()
    {
        return $this->hasMany('App\Premi');
    }

    public function edicio()
    {
        return $this->belongsTo('App\Edicio');
    }
}
