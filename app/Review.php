<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $table = "review";
    public $timestamps = false;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'score', 'content', 'date_review', 'deleted_at', 'id_tour', 'id_user'
    ];

    public function tour()
    {
    	return $this->belongsTo('App\Tour', 'id_tour', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }
}
