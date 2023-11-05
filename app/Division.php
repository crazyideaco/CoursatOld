<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\College;
use App\Section;
use App\SubjectsCollege;
use App\TypesCollege;
use App\Lesson;
use App\User;
use App\University;
class Division extends Model
{
    protected  $guarded = [];
    
      protected $table = 'division';
    public function college(){
        return $this->belongsTo(College::class,'college_id');
    }
    public function section(){
        return $this->hasMany(Section::class,'division_id');
    }
     public function subjectscollege(){
        return $this->hasMany(SubjectsCollege::class,'division_id');
    }
    public function typescollege(){
         return $this->hasMany(TypesCollege::class,'division_id');
     }
      public function lessons(){
         return $this->hasMany(Lesson::class,'division_id');
     }
      public function users(){
         return $this->hasMany(User::class,division_id);
     }
      public function university(){
         return $this->belongsTo(University::class,'university_id');
     }public function doctors(){
        return $this->belongsToMany(User::class, 'doctors_divisions','division_id','doctor_id');
    }
}
