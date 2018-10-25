<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formality extends Model
{
    protected $table = "formality";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function person_order()
    {
        return $this->hasMany('App\PersonOrder','id_formality','id');
    }
}
