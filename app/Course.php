<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sub;
use App\General;
use App\User;
use App\Course_Rate;
use App\VideosGeneral;
class Course extends Model
{
     protected  $guarded = [];
      protected $table = "course";
      public function sub(){
          return $this->belongsTo(Sub::class,'sub_id');
      }
      public function general(){
          return $this->belongsTo(General::class,'general_id');
      }
      public function user(){
         return $this->belongsTo(User::class,'user_id');
      }
      public function getUserNameAttribute(){
        return $this->user->name ?? "";
      }
      public function center(){
         return $this->belongsTo(User::class,'center_id');
     }public function rates(){
          return $this->hasMany(Course_Rate::class,'course_id');
      }    public function videos(){
          return $this->hasMany(VideosGeneral::class,'course_id');
      }public function studentscourses(){
        return $this->belongsToMany(User::class, 'students_courses','course_id','student_id');
    }
}