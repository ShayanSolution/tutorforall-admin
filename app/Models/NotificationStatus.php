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

    public function showDescription(){

        $value = $this->description;

        $strLength = 10;

        return
            strlen($value) > $strLength
                ?
                substr($value, 0, $strLength).'....  <a data-toggle="modal" style="cursor:pointer" data-target="#showMore'.$this->id.'">Show More</a>'
                :
                $value;
    }
}
