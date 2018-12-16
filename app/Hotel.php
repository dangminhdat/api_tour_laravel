<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hotel
 */
class Hotel extends Model
{
    protected $table = "hotel";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'price_room', 'phone', 'website', 'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * Relation detail tour
     * @return object
     */
    public function detail_tour()
    {
        return $this->belongsToMany('App\DetailTour','hotel_tour', 'id_hotel', 'id_detail_tour');
    }
}
