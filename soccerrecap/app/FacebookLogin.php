<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacebookLogin extends Model
{
    protected $table = 'facebook_login';

    protected $fillable = [
        'facebook_user_id',
        'full_name',
        'email'
    ];
}
