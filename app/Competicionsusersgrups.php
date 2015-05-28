<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Competicionsusersgrups extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'competicions_users_grups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['competicio_id', 'grup_id', 'user_id'];

    public function grup()
    {
        return $this->belongsTo('App\Grup');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function competicio()
    {
        return $this->belongsTo('App\Competicio');
    }


}