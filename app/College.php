<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Section;
use App\Division;
use App\SubjectsCollege;
use App\TypesCollege;
use App\Lesson;
use App\User;
use App\University;
class College extends Model
{
    protected  $guarded = [];
    
      protected $table = 'college';
    public function divisions(){
        return $this->hasMany(Division::class,'college_id');
    }
    public function sections(){
        return $this->hasMany(Section::class,'college_id');
    }
    public function subjectscollege(){
        return $this->hasMany(SubjectsCollege::class,'college_id');
    }
    public function typescollege(){
         return $this->hasMany(TypesCollege::class,'college_id');
     }
      public function lessons(){
         return $this->hasMany(Lesson::class,'college_id');
     }
     public function users(){
         return $this->hasMany(User::class,college_id);
     }
     public function university(){
         return $this->belongsTo(University::class,'university_id');
     }
}
