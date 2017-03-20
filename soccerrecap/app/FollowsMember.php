<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowsMember extends Model
{
    protected $table = 'follow_member';

    protected $fillable = [
        'member_id',
        'follow_member_id',
    ];
}
