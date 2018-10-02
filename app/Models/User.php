<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    public $remember_token=false;
    protected $fillable = [
        'uid',
        'firstName',
        'lastName',
        'fatherName',
        'phone',
        'email',
        'password',
        'dob',
        'gender_id',
        'cnic_no',
        'is_active',
        'role_id',
        'experience',
        'qualification'
    ];

    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    public function rating()
    {
        return $this->hasMany("App\Models\Rating");
    }
}
