<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $fillable = [
        'name',
        'status',
        'programme_id',
    ];
    public function program(){
        return $this->belongsTo('App\Models\Program', 'programme_id');
    }
}
