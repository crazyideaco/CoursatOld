<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\City;
use App\Users;
class State extends Model
{
     protected  $guarded = [];
      protected $table = "states";
      public function cities(){
          return $this->hasMany(City::class,'state_id');
      }
      public function users(){
          return$this->hasMany(User::class,'state_id');
      }
}