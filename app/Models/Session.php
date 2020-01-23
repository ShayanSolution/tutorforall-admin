<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public function student()
    {
        return $this->belongsTo('App\Models\User', 'student_id');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject', 'subject_id');
    }

    public function program()
    {
        return $this->belongsTo('App\Models\Program', 'programme_id');
    }
}
