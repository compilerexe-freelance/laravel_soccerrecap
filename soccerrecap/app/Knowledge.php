<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Knowledge extends Model
{
    protected $table = 'knowledge';

    protected $fillable = [
        'tag_name',
        'tag_link',
        'sort'
    ];
}
