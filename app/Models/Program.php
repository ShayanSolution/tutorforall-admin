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
        'note',
        'status',
    ];

    protected $softDelete = true;

    public function subjects(){
        return $this->hasMany('App\Models\Subject','programme_id');
    }

    public function showMessage(){

        $value = $this->note;

        $strLength = 10;

        return
            strlen($value) > $strLength
                ?
                substr($value, 0, $strLength).'....  <a data-toggle="modal" style="cursor:pointer" data-target="#showMessage'.$this->id.'">Show More</a>'
                :
                $value;
    }
}
