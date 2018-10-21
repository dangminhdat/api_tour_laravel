<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeTour extends Model
{
    protected $table = "type_tour";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function tour()
    {
        return $this->hasMany('App\Tour','id_type_tour','id');
    }
}
