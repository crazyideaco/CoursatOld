<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\User;
use App\Course;
use App\SubjectquestionAnswer;
use App\VideosgeneralexamQuestion;
use App\VideosGeneral;
class VideosgeneralExam extends Model
{
     protected  $guarded = [];
      protected $table = "videosgeneral_exams";
      public function sub(){
          return $this->belongsTo(Sub::class,'sub_id');
      }
       public function general(){
          return $this->belongsTo(General::class,'general_id');
      }  public function course(){
         return $this->belongsTo(Course::class,'course_id');
      }public function videogeneral(){
         return $this->belongsTo(VideosGeneral::class,'videosgeneral_id');
      }public function questions(){
        return $this->hasMany(VideosgeneralexamQuestion::class,'videosgeneralexam_id');
      }
      
}
