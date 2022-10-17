<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Type;
use App\User;
class TypeJoin extends Model
{
     protected  $guarded = [];
      protected $table = "type_joins";
      public function type(){
        return $this->belongsTo(Type::class,'type_id');
     }public function user(){
        return $this->belongsTo(User::class,'user_id');
    }public function student(){
        return $this->belongsTo(User::class,'student_id');
    }
}