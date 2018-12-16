<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserDetail
 */
class UserDetail extends Model
{
    protected $table = "user_detail";
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'fullname', 'email', 'phone', 'address', 'id_user', 'deleted_at'
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
    public function users()
    {
    	return $this->belongsTo('App\User','id_user','id');
    }
}
