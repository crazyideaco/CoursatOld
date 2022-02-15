<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\User;
use App\SubtypeexamquestionsAnswer;
use App\SubtypeExam;
class SubtypeexamQuestion extends Model
{
     protected  $guarded = [];
      protected $table = "subtypeexams_questions";
    public function typeexam(){
   return $this->belongsTo(SubtypeExam::class,'typeexam_id ');
      }public function answers(){
        return $this->hasMany(SubtypeexamquestionsAnswer::class,'subtypeexamquestion_id');
      }
      
}