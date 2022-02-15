<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Genral;
use App\Course;
use App\Sub;
use App\User;
class VideosGeneral extends Model
{
     protected  $guarded = [];
      protected $table = "videosgeneral";
            public function sub(){
          return $this->belongsTo(Sub::class,'sub_id');
      }
      public function general(){
          return $this->belongsTo(General::class,'general_id');
      }
      public function course(){
          return $this->belongsTo(Course::class,'course_id');
      } public function user(){
         return $this->belongsTo(User::class,'user_id');
      }public function center(){
         return $this->belongsTo(User::class,'center_id');
     }
      
}