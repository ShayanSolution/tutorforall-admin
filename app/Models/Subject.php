<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;

    protected $table = 'subjects';
    protected $fillable = [
        'name',
        'status',
        'programme_id',
    ];

    protected $softDelete = true;

    public function programme(){
        return $this->belongsTo('App\Models\Program', 'programme_id');
    }

//    public function profiles(){
//        return $this->hasMany('App\Models\Profile');
//    }
}
