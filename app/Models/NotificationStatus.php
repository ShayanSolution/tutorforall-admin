<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationStatus extends Model
{
    protected $table = 'notifications_status';

    protected $fillable = [
        'notification_id',
        'receiver_id',
        'notification_type',
        'read_status'
    ];
}
