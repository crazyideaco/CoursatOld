<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Subject;
use App\Year;
class Specialbasic extends Model
{
  protected  $guarded = [];
    
      protected $table = 'specialbasic';
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
      public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }
      public function year(){
        return $this->belongsTo(Year::class,'year_id');
    }
    
}
