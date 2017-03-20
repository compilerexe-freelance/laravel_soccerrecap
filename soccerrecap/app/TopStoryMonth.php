<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopStoryMonth extends Model
{
    protected $table = 'top_story_month';

    protected $fillable = [
        'month',
        'story_id_1',
        'story_id_2',
        'story_id_3',
        'story_id_4',
        'story_id_5',
        'story_id_6',
        'story_id_7',
        'story_id_8',
        'story_id_9',
        'story_id_10'
    ];
}
