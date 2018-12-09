<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TypeTour
 */
class TypeTour extends Model
{
    protected $table = "type_tour";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name'
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
        return $this->hasMany('App\DetailTour', 'id_type_tour', 'id');
    }
}
