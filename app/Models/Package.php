<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;

    protected $table = 'packages';
    protected $fillable = [
        'category_id',
        'hourly_rate',
        'extra_percentage_for_group_of_two',
        'extra_percentage_for_group_of_three',
        'extra_percentage_for_group_of_four',
        'is_active',
    ];

    protected $softDelete = true;

    public function packages(){
        return $this->hasOne('App\Models\Package','category_id');
    }

}
