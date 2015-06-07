<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Assistencia extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'assistencies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['accio', 'user_id', 'edicio_id'];

    public function edicio()
    {
        return $this->belongsTo('App\Edicio');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
