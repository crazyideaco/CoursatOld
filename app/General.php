<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sub;
use App\Course;
use App\Category;
class General extends Model
{
     protected  $guarded = [];
      protected $table = "general";
      public function sub(){
          return $this->hasMany(Sub::class,'sub_id');
      }
      public function courses(){
          return $this->hasMany(Course::class,'sub_id');
      }
      public function category(){
          return $this->belongsTo(Category::class,'category_id');
      }
}