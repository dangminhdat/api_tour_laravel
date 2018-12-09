<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Review
 */
class Review extends Model
{
    protected $table = "review";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'score', 'content', 'date_review', 'deleted_at', 'id_tour', 'id_user'
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

    /**
     * Relation user
     * @return object
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }
}
