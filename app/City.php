<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\State;
use App\City;
class City extends Model
{
     protected  $guarded = [];
      protected $table = "cities";
      public function state(){
          return $this->belongsTo(State::class,'state_id');
      }
       public function users(){
          return$this->hasMany(User::class,'city_id');
      }
   
}