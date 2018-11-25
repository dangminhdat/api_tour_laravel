<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    //
    protected $table = "tour";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'number_days', 'date_created', 'item_tour', 'discount', 'images', 'programs', 'note', 'deleted_at', 'id_type_tour'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function review()
    {
    	return $this->hasMany('App\Review', 'id_tour', 'id');
    }

    public function detail_tour()
    {
        return $this->hasMany('App\DetailTour', 'id_tour', 'id');
    }

    public function type_tour()
    {
        return $this->belongsTo('App\TypeTour', 'id_type_tour', 'id');
    }

    public function location()
    {
        return $this->belongsToMany('App\Location', 'location_tour', 'id_tour', 'id_location');
    }

    public function image()
    {
        return $this->hasMany('App\Image', 'id_tour', 'id');
    }
}
