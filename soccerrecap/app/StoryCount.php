<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoryCount extends Model
{
    protected $table = 'story_count';

    protected $primaryKey = 'story_id';

    protected $fillable = [
        'story_id',
        'count_view',
        'count_like'
    ];
}
