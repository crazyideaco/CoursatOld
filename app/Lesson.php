<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Section;
use App\Division;
use App\SubjectsCollege;
use App\TypesCollege;
use App\College;
use App\University;
use App\VideosCollege;
use App\LessonExam;
use App\Tag;
class Lesson extends Model
{
    protected  $guarded = [];
    
      protected $table = 'lessons';
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
     }
     public function typescollege(){
        return $this->belongsTo(TypesCollege::class,'typescollege_id');
     }public function university(){
        return $this->belongsTo(University::class,'university_id');
    }public function videos(){
        return $this->hasMany(VideosCollege::class,'lesson_id');
    }public function exams(){
         return $this->hasMany(LessonExam::class,'lesson_id');   
      }public function attendstudents(){
        return $this->belongsToMany(User::class, 'lessons_studentsattendance','lesson_id','student_id');
      }public function tags(){
        return $this->belongsToMany(Tag::class, 'lessons_tags','lesson_id','tag_id');
    }
     
   
}