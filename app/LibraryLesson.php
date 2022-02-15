<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Lesson;
class LibraryLesson extends Model
{
     protected  $guarded = [];
      protected $table = "library_lessons";
   public function lesson(){
    return $this->belongsTo(Lesson::class,'lesson_id');
  }
}