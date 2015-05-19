<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupform extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'grupsform';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['position', 'grup_id'];

    public function grup()
    {
        return $this->belongsTo('App\Grup');
    }

    public function competicionsusersgrups()
    {
        return $this->hasMany('App\Competicionsusersgrups');
    }

}