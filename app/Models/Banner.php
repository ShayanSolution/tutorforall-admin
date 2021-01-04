<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'text',
        'hyperlink',
        'path',
        'storage_path',
        'created_by',
        'send_to_csv',
    ];
}
