<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

    const STATUS_PENDING    = 2;
    const STATUS_ACCEPTED   = 1;
    const STATUS_REJECTED   = 0;

    protected $fillable = [
        'rejection_reason',
        'status',
        'verified_by',
        'verified_at'
    ];

    public function getStatusAttribute($value){

        if($value == 0)
            $status = 'Rejected';
        else if($value == 1)
            $status = 'Accepted';
        else
            $status = 'Pending';

        return $status;
    }

    public function showRejectionReason(){

        $value = $this->rejection_reason;

        $strLength = 10;

        return
            strlen($value) > $strLength
                ?
            substr($value, 0, $strLength).'....  <a data-toggle="modal" style="cursor:pointer" data-target="#showMore'.$this->id.'">Show More</a>'
                :
            $value;
    }

    public function getVerifiedByAttribute($value){

        $verified_by = User::find($value);
        if($verified_by)
            return $verified_by->firstName.' '.$verified_by->lastName;
        else
            return 'N-A';
    }

    public function getVerifiedAtAttribute($value){
        if($value != '')
            return Carbon::parse($value)->format('Y/m/d h:i A');
    }

    public function getPathAttribute($relativePath){
        return env('ASSET_BASE_URL').$relativePath;
    }

    public function tutor(){
        return $this->belongsTo(User::class, 'tutor_id', 'id');
    }

}
