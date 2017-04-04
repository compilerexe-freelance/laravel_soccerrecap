<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionMember extends Model
{
    protected $table = 'permission_member';

    protected $primaryKey = 'member_id';

    protected $fillable = [
        'member_id',
        'temporary_suspend',
        'suspended'
    ];

}
