<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student_Typecollege extends Model
{
    use SoftDeletes;
    protected  $guarded = [];
    protected $table = "students_typescollege";
}
