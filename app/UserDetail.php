<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = "user_detail";
    public $timestamps = false;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'email', 'phone', 'id_user', 'deleted_at'
    ];

    /**
     * user detail belongs to user
     * @return [type] [description]
     */
    public function users()
    {
    	return $this->hasOne('App\User','id_user','id');
    }
}