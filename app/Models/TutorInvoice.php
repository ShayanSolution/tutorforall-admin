<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class TutorInvoice extends Model
{
    protected $table = 'tutor_invoices';
    public function tutor(){
        return $this->belongsTo(User::class, 'tutor_id');
    }
}