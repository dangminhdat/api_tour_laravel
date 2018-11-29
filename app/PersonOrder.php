<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonOrder extends Model
{
    protected $table = "person_order";
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'note', 'num_adults', 'num_childs', 'date_ordered', 'deleted_at', 'id_detail_tour', 'id_user'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
    ];

    public function detail_tour()
    {
    	return $this->hasOne('App\DetailTour', 'id_detail_tour', 'id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'id_user', 'id');
    }
}
