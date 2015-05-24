<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Edicio extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'edicions';

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

    public function assignacio()
    {
        return $this->hasOne('App\Assignacio');
    }

    public function assistencia()
    {
        return $this->hasOne('App\Assistencia');
    }

    public function competicio()
    {
        return $this->hasOne('App\Competicio');
    }

    public function grup()
    {
        return $this->hasOne('App\Grup');
    }

    public function motiu()
    {
        return $this->hasOne('App\Motiu');
    }

    public function patrocinador()
    {
        return $this->hasOne('App\Patrocinador');
    }

    public function premi()
    {
        return $this->hasOne('App\Premi');
    }
}
