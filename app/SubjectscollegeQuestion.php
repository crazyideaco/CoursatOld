<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Section;
use App\Division;
use App\College;
use App\SubjectsCollege;
use App\Lesson;
use App\University;
use App\User;
use App\Typecollege_Rate;
use App\VideosCollege;
use App\Year;
use App\Subject;
use App\Type;
use App\SubjectscollegequestionAnswer;
use App\Video;
use App\SubjectscollegePart;
class SubjectscollegeQuestion extends Model
{
     protected  $guarded = [];
      protected $table = "subjectscollege_questions";
      public function college(){
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
     }public function doctor(){
         return $this->belongsTo(User::class,'doctor_id');
     }  public function answers(){
          return $this->hasMany(SubjectscollegequestionAnswer::class,'subjectscollegequestion_id');
      }public function subjectpart(){
          return $this->belongsTo(SubjectscollegePart::class,'subjectscollegepart_id');
      } 
      
}
