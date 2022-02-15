<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subject;
use App\Type;
use App\Video;
use App\Stage;
class Year extends Model
{
     protected  $guarded = [];
     protected $table = "years";
     public function subjects(){
         return $this->hasMany(Subject::class,'years_id');
     }
      public function types(){
          return $this->hasMany(Type::class,'subjects_id');
      }
       public function subtypes(){
          return $this->hasMany(Subtype::class,'years_id');
      }
       public function videos(){
        return $this->hasMany(Video::class,'year_id');
    }
    public function stage(){
        return $this->belongsTo(Stage::class,'stage_id');
    }
}
