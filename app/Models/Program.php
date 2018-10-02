<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'programmes';
    protected $fillable = [
        'name',
        'status',
    ];

    public function subjects(){
        return $this->hasMany('App\Models\Subject');
    }
}
