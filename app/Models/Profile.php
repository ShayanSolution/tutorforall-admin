<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'is_mentor',
        'is_deserving',
        'meeting_type_id',
        'user_id',
        'subject_id',
        'programme_id',
        'is_home',
        'is_group',
        'one_on_one',
        'call_tutor',
        'call_student',
    ];
    protected $table = 'profiles';
}
