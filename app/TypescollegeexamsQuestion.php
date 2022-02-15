<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TypescollegeexamquestionAnswer;
use App\TypescollegeExam;
class TypescollegeexamsQuestion extends Model
{
     protected  $guarded = [];
      protected $table = "typescollegeexams_questions";
    public function typescollegeexam(){
   return $this->belongsTo(TypescollegeExam::class,'typescollegeexam_id');
      }public function answers(){
        return $this->hasMany(TypescollegeexamquestionAnswer::class,'typescollegeexamquestion_id');
      }
      
}
