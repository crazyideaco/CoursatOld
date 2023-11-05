<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\User;
use App\SubjectquestionAnswer;
use App\CourseexamQuestion;
use App\Video;
class CourseExam extends Model
{
     protected  $guarded = [];
      protected $table = "courses_exams";
      public function sub(){
          return $this->belongsTo(Sub::class,'sub_id');
      }
       public function general(){
          return $this->belongsTo(General::class,'general_id');
      }  public function course(){
         return $this->belongsTo(Course::class,'course_id');
      }public function questions(){
        return $this->hasMany(CourseexamQuestion::class,'courseexam_id');
      }
      
}
