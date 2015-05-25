<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Competicio extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'competicions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'logo', 'imatge', 'number', 'edicio_id'];

    public function competicionsusersgrups()
    {
        return $this->hasMany('App\Competicionsusersgrups');
    }

    public function edicio()
    {
        return $this->belongsTo('App\Edicio');
    }
}