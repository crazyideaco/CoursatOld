<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\TypescollegeExam;
class TypescollegeexamResult extends Model
{
     protected  $guarded = [];
      protected $table = "typescollegeexams_results";
    public function student(){
    return $this->belongsTo(User::class,'student_id');
  }public function exam(){
      return $this->belongsTo(TypescollegeExam::class,'exam_id');
  }
}
      