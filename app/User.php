<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /*
    protected $table = 'fm_users';

    protected $primaryKey = 'user_id';

    public $timestamps = false;

    const UPDATED_AT = 'user_last_login';

    const CREATED_AT = 'user_registered';
    */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $timestamps = false;

    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'bgimage'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

}
