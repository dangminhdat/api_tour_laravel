<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 */
class User extends Authenticatable implements JWTSubject
{
    protected $table = "users";
    public $timestamps = false;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'active', 'login_code', 'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Relation user detail
     * @return object
     */
    public function user_detail()
    {
        return $this->hasOne('App\UserDetail', 'id_user', 'id');
    }

    /**
     * Relation review
     * @return object
     */
    public function review()
    {
        return $this->hasMany('App\Review', 'id_user', 'id');
    }

    /**
     * Relation group
     * @return object
     */
    public function group()
    {
        return $this->belongsToMany('App\Group','group_user', 'id_user', 'id_group');
    }

    /**
     * Get JWT Identifier
     * @return object
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get JWT Custom Claims
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
