<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $table = 'bookmark';

    protected $fillable = [
        'member_id',
        'story_id',
        'status'
    ];
}
