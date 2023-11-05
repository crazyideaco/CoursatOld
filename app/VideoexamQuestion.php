<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\User;
use App\SubtypeexamquestionsAnswer;
use App\VideoExam;
class VideoexamQuestion extends Model
{
     protected  $guarded = [];
      protected $table = "videoexams_questions";
    public function videoexam(){
   return $this->belongsTo(VideoExam::class,'videoexam_id ');
      }public function answers(){
        return $this->hasMany(VideoexamquestionsAnswer::class,'videoexamquestion_id');
      }
      
}