<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class guide
 */
class Guide extends Model
{
    protected $table = "guide";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'phone', 'deleted_at'
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
        return $this->hasOne('App\DetailTour', 'id_guide', 'id');
    }
}
