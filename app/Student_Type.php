<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student_Type extends Model
{
    use SoftDeletes;
    protected  $guarded = [];
    protected $table = "students_types";
}
