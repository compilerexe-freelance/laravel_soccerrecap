<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationFollow extends Model
{
    protected $table = 'notification_follow';

    protected $fillable = [
        'follows_id',
        'alert_member_id',
        'status'
    ];
}
