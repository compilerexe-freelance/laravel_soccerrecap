<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';

    protected $fillable = [
        'story_id',
        'member_id',
        'comment_title',
        'comment_detail'
    ];
}
