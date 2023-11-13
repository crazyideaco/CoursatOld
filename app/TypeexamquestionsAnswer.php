<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\User;
use App\SubjectquestionAnswer;
use App\TypeExam;
class TypeexamquestionsAnswer extends Model
{
     protected  $guarded = [];
      protected $table = "typeexamquestions_answers";
   
      
}
