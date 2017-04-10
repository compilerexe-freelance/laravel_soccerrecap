<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class FacebookLogin extends Model implements Authenticatable
{
    use AuthenticableTrait;

    protected $table = 'facebook_login';

    protected $fillable = [
        'facebook_user_id',
        'full_name',
        'email'
    ];

    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
}
