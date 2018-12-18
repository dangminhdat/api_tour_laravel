<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonOrder
 */
class PersonOrder extends Model
{
    protected $table = "person_order";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'note', 'pay', 'num_adults', 'num_childs', 'date_ordered', 'status', 'deleted_at', 'id_detail_tour', 'id_user'
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
    	return $this->belongsTo('App\DetailTour', 'id_detail_tour', 'id');
    }

    /**
     * Relation user
     * @return object
     */
    public function user()
    {
    	return $this->belongsTo('App\User', 'id_user', 'id');
    }
}
