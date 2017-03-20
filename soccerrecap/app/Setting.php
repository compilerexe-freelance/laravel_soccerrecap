<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'setting';

    protected $primaryKey = 'member_id';

    protected $fillable = [
        'member_id',
        'status_new_sletter'
    ];
}
