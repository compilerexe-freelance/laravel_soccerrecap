<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EditorPick extends Model
{
    protected $table = 'editor_pick';

    protected $fillable = [
        'story_id_1',
        'story_id_2',
        'story_id_3',
        'story_id_4',
        'story_id_5'
    ];
}
