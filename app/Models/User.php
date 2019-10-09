<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Illuminate\Auth\Passwords\CanResetPassword as CanResetPassword;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements CanResetPasswordInterface
{
    use SoftDeletes, CanResetPassword, Notifiable;
    
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
        return $this->hasMany("App\Models\Rating")->orderBy('created_at', 'Desc');
    }
    public function program_subject()
    {
        return $this->hasMany("App\Models\ProgramSubject");
    }
}
