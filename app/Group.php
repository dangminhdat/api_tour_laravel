<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Group
 */
class Group extends Model
{
    protected $table = "groups";
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
     * Relation user
     * @return object
     */
    public function user()
    {
        return $this->belongsToMany('App\User','group_user', 'id_group', 'id_user');
    }

    /**
     * Relation permission
     * @return object
     */
    public function permission()
    {
    	return $this->hasMany('App\Permission', 'id_group', 'id');
    }
}
