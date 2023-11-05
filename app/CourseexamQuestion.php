<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\User;
use App\TypeexamquestionsAnswer;
use App\CourseExam;
class CourseexamQuestion extends Model
{
     protected  $guarded = [];
      protected $table = "courseexams_questions";
    public function courseexam(){
   return $this->belongsTo(CourseExam::class,'courseexam_id');
      }public function answers(){
        return $this->hasMany(CourseexamquestionAnswer::class,'courseexamquestion_id');
      }
      
}
