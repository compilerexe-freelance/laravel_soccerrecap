<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';

    protected $primaryKey = 'member_id';

    protected $fillable = [
        'member_id',
        'image_profile',
        'cover_profile',
        'describe_profile'
    ];
}
