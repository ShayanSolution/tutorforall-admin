<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PercentageCostForMultiStudentGroup extends Model
{
    use SoftDeletes;

    protected $table = 'percentage_cost_for_multistudent_group';

    protected $fillable = ['number_of_students', 'percentage', 'is_active'];
}
