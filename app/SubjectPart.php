<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubjectQuestion;
use App\Year;
use App\Subject;
class SubjectPart extends Model
{
     protected  $guarded = [];
      protected $table = "subjects_parts";
  public function questions(){
       return $this->hasMany(SubjectQuestion::class,'subjectpart_id');
    }   public function year(){
          return $this->belongsTo(Year::class,'years_id');
      }
      public function subject(){
          return $this->belongsTo(Subject::class,'subjects_id');
      } 
}