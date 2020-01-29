<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public function tutor(){
        return $this->belongsTo(User::class, 'tutor_id');
    }

    public function student(){
        return $this->belongsTo(User::class, 'student_id');
    }

    public function class(){
        return $this->belongsTo(Program::class, 'programme_id');
    }

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function setDurationAttribute($value){
        $this->attributes['duration'] = \Carbon\Carbon::parse($value)->format('H:i:s');
    }

    public function getDurationAttribute($value){
        return \Carbon\Carbon::parse($value)->format('H:i:s');
    }
}
