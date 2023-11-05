<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Type;
use App\Video;
use App\User;
use App\Stage;
use App\SubjectQuestion;
class Subject extends Model
{
     protected  $guarded = [];
      protected $table = "subjects";
      public function year(){
          return $this->belongsTo(Year::class,'years_id');
      }
      public function types(){
          return $this->hasMany(Type::class,'subjects_id');
      }
      public function stage(){
          return $this->belongsTo(Stage::class,'stage_id');
      }
       public function subtypes(){
          return $this->hasMany(Subtype::class,'subjects_id');
      }
      public function videos(){
        return $this->hasMany(Video::class,'subject_id');
    }
    public function users(){
        return $this->hasMany(User::class,'subject_id');
    }
    public function teachers(){
        return $this->belongsToMany(User::class, 'users_subjects','subject_id','user_id');
    }public function questions(){
              return $this->hasMany(SubjectQuestion::class,'subjects_id');
    }
}
