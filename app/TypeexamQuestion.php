<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\User;
use App\TypeexamquestionsAnswer;
use App\TypeExam;
class TypeexamQuestion extends Model
{
     protected  $guarded = [];
      protected $table = "typeexams_questions";
    public function typeexam(){
   return $this->belongsTo(TypeExam::class,'typeexam_id');
      }public function answers(){
        return $this->hasMany(TypeexamquestionsAnswer::class,'typeexamquestion_id');
      }
      
}
