<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\TypeExam;
class TypeexamResult extends Model
{
     protected  $guarded = [];
      protected $table = "typeexams_results";
  public function student(){
    return $this->belongsTo(User::class,'student_id');
  }public function exam(){
      return $this->belongsTo(TypeExam::class,'exam_id');
  }
}
      