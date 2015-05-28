<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Grup extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'grups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'edicio_id', 'competicio_id'];

    public function competicionsusersgrups()
    {
        return $this->hasMany('App\Competicionsusersgrups');
    }

    public function competicio()
    {
        return $this->belongsTo('App\Competicio');
    }

    public function edicio()
    {
        return $this->belongsTo('App\Edicio');
    }
}