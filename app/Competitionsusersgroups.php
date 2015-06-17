<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Competitionsusersgroups extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'competitions_users_groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['competition_id', 'group_id', 'user_id'];

    public function group()
    {
        return $this->belongsTo('App\Group');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function competition()
    {
        return $this->belongsTo('App\Competition');
    }


}