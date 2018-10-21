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
        'name_review', 'email_review', 'score', 'content', 'date_review', 'deleted_at', 'id_tour'
    ];

    /**
     * user detail belongs to user
     * @return [type] [description]
     */
    public function tour()
    {
    	return $this->belongsTo('App\Tour','id_tour','id');
    }
}
