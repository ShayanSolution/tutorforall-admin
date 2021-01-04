<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerStatus extends Model
{
    protected $table = 'banners_status';
    protected $fillable = [
        'banner_id',
        'receiver_id',
        'is_read'
    ];
}
