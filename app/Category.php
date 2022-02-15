<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Stage;
class Category extends Model
{
     protected  $guarded = [];
      protected $table = "category";
      public function stages(){
          return $this->hasMany(Stage::class,'category_id');
      }
}