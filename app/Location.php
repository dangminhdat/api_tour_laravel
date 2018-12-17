<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Location
 */
class Location extends Model
{
    protected $table = "location";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * Relation tour
     * @return object
     */
    public function tour()
    {
        return $this->belongsToMany('App\Tour','location_tour', 'id_location', 'id_tour');
    }
}
