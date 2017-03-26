<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RememberLike extends Model
{

    protected $table = 'remember_like';

    protected $primaryKey = 'member_id';

    protected $fillable = [
        'member_id',
        'story_id'
    ];
}
