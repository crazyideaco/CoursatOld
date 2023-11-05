<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sub;
use App\General;
use App\Course;
use App\User;
class GroupCourse extends Model
{
     protected  $guarded = [];
      protected $table = "groupscourses";
       public function sub(){
          return $this->belongsTo(Sub::class,'sub_id');
      }
      public function general(){
          return $this->belongsTo(General::class,'general_id');
      }
      public function course(){
          return $this->belongsTo(Course::class,'course_id');
      }public function students(){
        return $this->belongsToMany(User::class, 'groupscourses_students','groupcourse_id','student_id');
    }
}
