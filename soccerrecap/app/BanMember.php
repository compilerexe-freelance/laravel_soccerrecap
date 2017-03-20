<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BanMember extends Model
{
    protected $table = 'ban_member';

    protected $primaryKey = 'member_id';

    protected $fillable = [
        'member_id',
        'status_disable',
        'status_ban'
    ];

}
