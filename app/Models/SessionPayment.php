<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionPayment extends Model
{
    protected $table = 'session_payments';

    public function session()
    {
        return $this->belongsTo('App\Models\Session');
    }
    public function disbursement()
    {
        return $this->morphOne('App\Models\Disbursement','paymentable');
    }
}
