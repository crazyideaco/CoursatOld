<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\User;
use App\VideoscollegeexamquestionAnswer;
use App\VideoscollegeExam;
class VideoscollegeeexamQuestion extends Model
{
     protected  $guarded = [];
      protected $table = "videoscollegeexams_questions";
    public function videoscollegeexam(){
   return $this->belongsTo(VideoscollegeExam::class,'videoscollegeexam_id');
      }public function answers(){
        return $this->hasMany(VideoscollegeexamquestionAnswer::class,'videoscollegeexamquestion_id');
      }
      
}