<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowsTag extends Model
{
    protected $table = 'follows_tag';

    protected $fillable = [
        'member_id',
        'follow_tag_id',
    ];
}
