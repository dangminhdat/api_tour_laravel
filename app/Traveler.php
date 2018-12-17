<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Traveler
 */
class Traveler extends Model
{
    protected $table = "traveler";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'gender', 'birth', 'cat_traveler', 'check_room', 'deleted_at', 'id_person_order'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * Relation person order
     * @return object
     */
    public function person_order()
    {
    	return $this->hasOne('App\PersonOrder', 'id_person_order', 'id');
    }
}
