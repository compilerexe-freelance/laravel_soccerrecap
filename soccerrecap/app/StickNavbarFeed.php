<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StickNavbarFeed extends Model
{
    protected $table = 'stick_navbar_feed';

    protected $fillable = [
        'story_id_1',
        'story_id_2'
    ];
}
