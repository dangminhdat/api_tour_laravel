<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'active', 'login_code', 'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function user_detail()
    {
        return $this->hasOne('App\UserDetail', 'id_user', 'id');
    }

    public function review()
    {
        return $this->hasMany('App\Review', 'id_user', 'id');
    }
}
