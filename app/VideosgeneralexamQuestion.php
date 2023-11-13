<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\User;
use App\VideosgeneralexamquestionAnswer;
use App\VideosgeneralExam;
use App\VideosGeneral;
class VideosgeneralexamQuestion extends Model
{
     protected  $guarded = [];
      protected $table = "videosgeneralexams_questions";
    public function videosgeneralexam(){
   return $this->belongsTo(VideosgeneralExam::class,'videosgeneralexam_id');
      }public function answers(){
        return $this->hasMany(VideosgeneralexamquestionAnswer::class,'videosgeneralexamquestion_id');
      }
      
}
