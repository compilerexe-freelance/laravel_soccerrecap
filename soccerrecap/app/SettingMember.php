<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingMember extends Model
{
    protected $table = 'setting_member';

    protected $primaryKey = 'member_id';

    protected $fillable = [
        'member_id',
        'status_new_sletter'
    ];
}
