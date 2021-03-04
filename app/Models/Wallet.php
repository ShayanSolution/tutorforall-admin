<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallets';

    protected $fillable = [
        'session_id',
        'amount',
        'type',
        'from_user_id',
        'to_user_id',
        'created_at',
        'updated_at',
        'notes',
    ];
}
