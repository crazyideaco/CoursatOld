<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student_Type extends Model
{
    use SoftDeletes;
    protected  $guarded = [];
    protected $table = "students_types";

    public function student(){
        return $this->belongsTo(User::class, 'student_id');
    }
}
