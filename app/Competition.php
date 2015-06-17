<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'competitions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'logo', 'imatge', 'number', 'state', 'link', 'data_inici', 'edition_id'];

    public function competitionsusersgroups()
    {
        return $this->hasMany('App\Competitionsusersgroups');
    }

    public function group()
    {
        return $this->hasMany('App\Group');
    }

    public function edition()
    {
        return $this->belongsTo('App\Edition');
    }

    /*
     *
     * // Module model
        public function sectionsCountRelation()
        {
            return $this->hasOne('Section')->selectRaw('module_id, count(*) as count')->groupBy('module_id');
            // replace module_id with appropriate foreign key if needed
        }


        // then you can access it like this:

        $modules = Module::with('sectionsCountRelation')->get();
        $modules->first()->sectionsCountRelation->count;

        // but there is a bit sugar to make it easier (and that s why I renamed it to sectionsCountRelation)

        public function getSectionsCountAttribute()
        {
            return $this->sectionsCountRelation->count;
        }

        // now you can simply do this on every module:
        $modules->first()->sectionsCount;
     *
     *
     */
}