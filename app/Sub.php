<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Genral;
use App\Course;
class Sub extends Model
{
     protected  $guarded = [];
      protected $table = "sub";
      public function general(){
          return $this->belongsTo(General::class,'general_id');
      }
      public function courses(){
          return $this->hasMany(Course::class,'general_id');
      }
}
