<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\SubtypeExam;
class SubtypeexamResult extends Model
{
     protected  $guarded = [];
      protected $table = "subtypeexams_results";
  public function student(){
    return $this->belongsTo(User::class,'student_id');
  }public function exam(){
      return $this->belongsTo(SubtypeExam::class,'exam_id');
  }
}
      