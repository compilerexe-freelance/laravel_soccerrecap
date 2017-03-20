<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $table = 'story';

    protected $fillable = [
        'member_id',
        'story_title',
        'story_picture',
        'story_detail'
    ];
}
