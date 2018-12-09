<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetailTour
 */
class DetailTour extends Model
{
    protected $table = "detail_tour";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'date_depart', 'price_adults', 'price_childs', 'time_depart', 'address_depart', 'slot', 'booked', 'deleted_at', 'id_guide', 'id_hotel', 'id_tour'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * Relation guide
     * @return object
     */
    public function guide()
    {
        return $this->belongsTo('App\Guide', 'id_guide', 'id');
    }

    /**
     * Relation tour
     * @return object
     */
    public function tour()
    {
        return $this->belongsTo('App\Tour', 'id_tour', 'id');
    }

    /**
     * Relation hotel
     * @return object
     */
    public function hotel()
    {
        return $this->belongsToMany('App\Hotel', 'hotel_tour', 'id_detail_tour', 'id_hotel');
    }

    /**
     * Relation person order
     * @return object
     */
    public function person_order()
    {
        return $this->hasMany('App\PersonOrder', 'id_detail_tour', 'id');
    }
}
