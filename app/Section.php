<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\College;
use App\Division;
use App\SubjectsCollege;
use App\TypesCollege;
use App\Lesson;
use App\User;
use App\University;
class Section extends Model
{
    protected  $guarded = [];
    
      protected $table = 'section';
     public function college(){
        return $this->belongsTo(College::class,'college_id');
    }
    public function division(){
        return $this->belongsTo(Division::class,'division_id');
    }
     public function subjectscollege(){
        return $this->hasMany(SubjectsCollege::class,'section_id');
    }
    public function typescollege(){
         return $this->hasMany(TypesCollege::class,'section_id');
     }
       public function lessons(){
         return $this->hasMany(Lesson::class,'section_id');
     }
     public function users(){
         return $this->hasMany(User::class,section_id);
     } public function university(){
         return $this->belongsTo(University::class,'university_id');
     }public function doctors(){
        return $this->belongsToMany(User::class, 'doctors_sections','section_id','doctor_id');
    }
}
