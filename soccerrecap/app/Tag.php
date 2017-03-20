<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';

    protected $fillable = [
        'story_id',
        'tag_name',
    ];
}
