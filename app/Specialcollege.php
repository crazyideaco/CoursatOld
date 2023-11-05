<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\College;
use App\Division;
use App\Section;
use App\Lesson;
use App\University;
use App\TypesCollege;
use App\SubjectsCollege;
class Specialcollege extends Model
{
  protected  $guarded = [];
      protected $table = 'specialcollege';
    public function doctor(){
        return $this->belongsTo(User::class,'doctor_id');
    }public function university(){
        return $this->belongsTo(University::class,'university_id');
    }
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
    	   return $this->belongsTo(SubjectsCollege::class,'subcollege_id');
    	}
}
