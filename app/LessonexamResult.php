<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\LessonExam;
class LessonexamResult extends Model
{
     protected  $guarded = [];
      protected $table = "lessonexams_results";
    public function student(){
    return $this->belongsTo(User::class,'student_id');
  }public function exam(){
      return $this->belongsTo(LessonExam::class,'exam_id');
  }
}
      