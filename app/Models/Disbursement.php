<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disbursement extends Model
{
    protected $table = 'disbursements';

    public function tutor(){
        return $this->belongsTo(User::class, 'tutor_id');
    }
//    public function sessionPayment()
//    {
//        return $this->hasOne('App\Models\SessionPayment');
//    }
    public function paymentable(){
            return $this->morphTo();
    }
}
