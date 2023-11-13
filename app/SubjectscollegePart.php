<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubjectscollegeQuestion;
use App\Section;
use App\Division;
use App\College;
use App\SubjectsCollege;
use App\Lesson;
use App\University;
class SubjectscollegePart extends Model
{
     protected  $guarded = [];
      protected $table = "subjectscollege_parts";
  public function questions(){
       return $this->hasMany(SubjectscollegeQuestion::class,'subjectscollegepart_id');
    }      public function college(){
        return $this->belongsTo(College::class,'college_id');
    }
     public function division(){
        return $this->belongsTo(Division::class,'division_id');
    }
     public function section(){
        return $this->belongsTo(Section::class,'section_id');
     }
     public function subjectscollege(){
        return $this->belongsTo(SubjectsCollege::class,'subjectscollege_id');
     }public function university(){
         return $this->belongsTo(University::class,'university_id');
     }
}