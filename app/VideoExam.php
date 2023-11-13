<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\User;
use App\SubjectquestionAnswer;
use App\SubtypeexamQuestion;
use App\Video;
use App\Subtype;
class VideoExam extends Model
{
     protected  $guarded = [];
      protected $table = "videos_exams";
      public function year(){
          return $this->belongsTo(Year::class,'years_id');
      }
      public function subject(){
          return $this->belongsTo(Subject::class,'subjects_id');
      }  public function type(){
         return $this->belongsTo(Type::class,'type_id');
      } public function subtype(){
         return $this->belongsTo(Subtype::class,'subtype_id');
      }public function video(){
           return $this->belongsTo(Video::class,'video_id');
      }public function questions(){
        return $this->hasMany(VideoexamQuestion::class,'videoexam_id');
      }
      
}
