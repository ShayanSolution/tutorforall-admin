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
}
