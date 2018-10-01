<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    public $remember_token=false;

    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }
}
