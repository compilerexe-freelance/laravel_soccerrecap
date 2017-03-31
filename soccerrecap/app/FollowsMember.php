<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowsMember extends Model
{
    protected $table = 'follows_member';

    protected $fillable = [
        'member_id',
        'follow_member_id',
    ];
}
