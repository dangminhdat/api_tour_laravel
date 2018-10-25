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
        'name', 'number_days', 'date_created', 'item_tour', 'discount', 'booked', 'images', 'programs', 'note'
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
        return $this->hasOne('App\DetailTour', 'id_tour', 'id');
    }
}
