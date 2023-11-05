<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\User;
use App\LessonexamquestionAnswer;
use App\LessonExam;
class LessonexamQuestion extends Model
{
     protected  $guarded = [];
      protected $table = "lessonexams_questions";
    public function lessonexam(){
   return $this->belongsTo(LessonExam::class,'lessonexam_id ');
      }public function answers(){
        return $this->hasMany(LessonexamquestionAnswer::class,'lessonexamquestion_id');
      }
      
}