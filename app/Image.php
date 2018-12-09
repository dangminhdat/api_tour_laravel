<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 */
class Image extends Model
{
    protected $table = 'images';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
    	"description", "url", "id_tour"
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
    	return $this->belongsTo('App\Tour', 'id_tour', 'id');
    }
}
