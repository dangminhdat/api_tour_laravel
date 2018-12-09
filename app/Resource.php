<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Resource
 */
class Resource extends Model
{
    protected $table = "resource";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * Relation permission
     * @return object
     */
    public function permission()
    {
    	return $this->hasMany('App\Permission', 'id_resource', 'id');
    }
}
