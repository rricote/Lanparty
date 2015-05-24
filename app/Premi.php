<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Premi extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'premis';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','edicio_id'];

    public function patrocinador()
    {
        return $this->belongsTo('App\Patrocinador');
    }

    public function edicio()
    {
        return $this->belongsTo('App\Edicio');
    }
}