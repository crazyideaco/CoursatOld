<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\City;
use App\Users;
use App\Category;
class Point extends Model
{
     protected  $guarded = [];
      protected $table = "points";
      public function category(){
          return $this->belongsto(Category::class,'category_id');
      }
      
}