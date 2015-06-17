<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'edicio_id', 'competition_id'];

    public function competitionsusersgroups()
    {
        return $this->hasMany('App\Competitionsusersgroups');
    }

    public function competition()
    {
        return $this->belongsTo('App\Competition');
    }

    public function edicio()
    {
        return $this->belongsTo('App\Edicio');
    }
}