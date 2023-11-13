<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\User;
use App\TypegroupDay;
use App\Video;
class GroupType extends Model
{
     protected  $guarded = [];
      protected $table = "groupstypes";
      public function year(){
          return $this->belongsTo(Year::class,'years_id');
      }
      public function subject(){
          return $this->belongsTo(Subject::class,'subjects_id');
      }
      public function type(){
          return $this->belongsTo(Type::class,'type_id');
      }public function students(){
        return $this->belongsToMany(User::class, 'groupstypes_students','grouptype_id','student_id');
    }public function days(){
        return $this->hasMany(TypegroupDay::class,'group_id');
      }
}
