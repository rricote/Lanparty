<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignacio extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'assignacions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'motiu_id', 'premi_id', 'edicio_id'];

    public function edicio()
    {
        return $this->belongsTo('App\Edicio');
    }
}