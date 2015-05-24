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
    protected $fillable = ['name', 'edicio_id'];

    public function grupform()
    {
        return $this->hasMany('App\Grupform');
    }
}