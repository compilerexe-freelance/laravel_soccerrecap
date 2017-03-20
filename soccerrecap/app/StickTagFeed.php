<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StickTagFeed extends Model
{
    protected $table = 'stick_tag_feed';

    protected $primaryKey = 'tag_id';

    protected $fillable = [
        'tag_id',
        'story_id',
    ];
}
