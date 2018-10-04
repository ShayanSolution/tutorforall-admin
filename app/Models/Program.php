<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use SoftDeletes;

    protected $table = 'programmes';
    protected $fillable = [
        'name',
        'status',
    ];

    protected $softDelete = true;

    public function subjects(){
        return $this->hasMany('App\Models\Subject','programme_id');
    }
}
