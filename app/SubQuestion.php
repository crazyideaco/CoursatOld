<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\User;
use App\SubquestionAnswer;
use App\Video;
use App\SubjectPart;
class SubQuestion extends Model
{
     protected  $guarded = [];
      protected $table = "sub_questions";
      public function year(){
          return $this->belongsTo(Year::class,'years_id');
      }
      public function subject(){
          return $this->belongsTo(Subject::class,'subjects_id');
      }  public function answers(){
          return $this->hasMany(SubquestionAnswer::class,'subquestion_id');
      }public function subjectpart(){
          return $this->belongsTo(SubjectPart::class,'subjectpart_id');
      } 
      
}
