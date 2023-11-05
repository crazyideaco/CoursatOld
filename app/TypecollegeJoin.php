<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TypesCollege;
use App\User;
class TypecollegeJoin extends Model
{
     protected  $guarded = [];
      protected $table = "typecollege_joins";
      public function typescollege(){
        return $this->belongsTo(TypesCollege::class,'typecollege_id');
     }public function user(){
        return $this->belongsTo(User::class,'user_id');
    }public function student(){
        return $this->belongsTo(User::class,'student_id');
    }
}