<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\College;
use App\Division;
use App\Section;
use App\Lesson;
use App\TypesCollege;
use App\SubjectsCollege;
use App\Videoscollege;
use App\VideoscollegeeexamQuestion;
class VideoscollegeExam extends Model
{
     protected  $guarded = [];
      protected $table = "videoscollege_exams";
 
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
    	public function lesson(){
    	    return $this->belongsTo(Lesson::class,'lesson_id');
    	}
    	
    public function typescollege(){
        return $this->belongsTo(TypesCollege::class,'typescollege_id');
    } public function videoscollege(){
        return $this->belongsTo(Videoscollege::class,'videoscollege_id');
    }public function questions(){
        return $this->hasMany(VideoscollegeeexamQuestion::class,'videoscollegeexam_id');
      }
      
}
