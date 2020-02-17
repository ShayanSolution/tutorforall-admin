<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'title',
        'message',
        'description',
        'image',
        'send_to',
        'created_by'
    ];

    public function showDescription(){

        $value = $this->description;

        $strLength = 10;

        return
            strlen($value) > $strLength
                ?
                substr($value, 0, $strLength).'....  <a data-toggle="modal" style="cursor:pointer" data-target="#showMore'.$this->id.'">Show More</a>'
                :
                $value;
    }
}
