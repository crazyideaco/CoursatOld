<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student_Course extends Model
{
    use SoftDeletes;
    protected  $guarded = [];
    protected $table = "students_courses";
}
