<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTour extends Model
{
    //
    protected $table = "detail_tour";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_depart', 'price_adults', 'price_childs', 'time_depart', 'address_depart', 'slot', 'deleted_at', 'id_image', 'id_guide', 'id_hotel', 'id_tour', 'id_type_tour'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function type_tour()
    {
    	return $this->belongsTo('App\TypeTour', 'id_type_tour', 'id');
    }

    public function guide()
    {
        return $this->belongsTo('App\Guide', 'id_guide', 'id');
    }

    public function tours()
    {
        return $this->belongsTo('App\Tour', 'id_tour', 'id');
    }

    public function location()
    {
        return $this->belongsToMany('App\Location', 'location_tour', 'id_detail_tour', 'id_location');
    }

    public function hotel()
    {
        return $this->belongsToMany('App\Hotel', 'hotel_tour', 'id_detail_tour', 'id_hotel');
    }
}
