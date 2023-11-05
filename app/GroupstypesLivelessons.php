<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\User;
use App\Video;
use App\GroupType;
class GroupstypesLivelessons extends Model
{
     protected  $guarded = [];
      protected $table = "groupstypes_livelessons";
      public function year(){
          return $this->belongsTo(Year::class,'years_id');
      }
      public function subject(){
          return $this->belongsTo(Subject::class,'subjects_id');
      }
      public function type(){
          return $this->belongsTo(Type::class,'type_id');
      } public function grouptype(){
          return $this->belongsTo(GroupType::class,'grouptype_id');
      }
}
