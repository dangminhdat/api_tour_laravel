<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    public $timestamps = false;

    protected $fillable = [
    	"description", "url", "id_tour"
    ];

    protected $hidden = [
    ];

    public function tour()
    {
    	return $this->belongsTo('App\Tour', 'id_tour', 'id');
    }
}
