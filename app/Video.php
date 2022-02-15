<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Subject;
use App\Year;
class Video extends Model
{
  protected  $guarded = [];
    
      protected $table = 'videos';
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
