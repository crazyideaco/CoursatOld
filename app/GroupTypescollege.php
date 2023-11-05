<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Section;
use App\Division;
use App\SubjectsCollege;
use App\TypesCollege;
use App\College;
use App\User;
use App\University;
use App\VideosCollege;
use App\TypescollegeGroupDay;
class GroupTypescollege extends Model
{
     protected  $guarded = [];
      protected $table = "groupstypescollege";
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
    }public function students(){
        return $this->belongsToMany(User::class, 'groupstypescollege_students','grouptypescollege_id','student_id');
    }public function days(){
        return $this->hasMany(TypescollegeGroupDay::class,'group_id');
      }
}
