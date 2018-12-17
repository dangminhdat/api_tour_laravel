<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 */
class Permission extends Model
{
    protected $table = "permission";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'is_create', 'is_view', 'is_update', 'is_delete', 'id_group', 'id_resource'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * Relation group
     * @return object
     */
    public function group()
    {
    	return $this->belongsTo('App\Group', 'id_group', 'id');
    }

    /**
     * Relation resource
     * @return object
     */
    public function resource()
    {
    	return $this->belongsTo('App\Resource', 'id_resource', 'id');
    }
}
