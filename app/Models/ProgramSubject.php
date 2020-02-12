<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramSubject extends Model
{
    const STATUS_PENDING    = 2;
    const STATUS_ACCEPTED   = 1;
    const STATUS_REJECTED   = 0;

    protected $table = 'program_subject';

    protected $fillable = [
        'program_id',
        'subject_id',
        'status',
        'user_id',
        'rejection_reason',
        'verified_at',
        'verified_by'
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

    public function program(){
        return $this->belongsTo('App\Models\Program','program_id');
    }
    public function subject(){
        return $this->belongsTo('App\Models\Subject','subject_id');
    }

    public function document(){
        return $this->belongsTo(Document::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
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
}
