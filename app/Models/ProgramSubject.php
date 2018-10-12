<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramSubject extends Model
{
    protected $table = 'program_subject';

    public function program(){
        return $this->belongsTo('App\Models\Program','program_id');
    }
    public function subject(){
        return $this->belongsTo('App\Models\Subject','subject_id');
    }
}
