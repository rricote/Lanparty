<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Edition extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'editions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'cartell'];

    public function config()
    {
        return $this->hasOne('App\Config');
    }

    public function assignment()
    {
        return $this->hasOne('App\Assignment');
    }

    public function assistance()
    {
        return $this->hasOne('App\Assistance');
    }

    public function competition()
    {
        return $this->hasOne('App\Competition');
    }

    public function group()
    {
        return $this->hasOne('App\Group');
    }

    public function motive()
    {
        return $this->hasOne('App\Motive');
    }

    public function sponsor()
    {
        return $this->hasOne('App\Sponsor');
    }

    public function present()
    {
        return $this->hasOne('App\Present');
    }
}
