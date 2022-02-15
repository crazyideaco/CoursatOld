<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Day;
class TypescollegeGroupDay extends Model
{
     protected  $guarded = [];
      protected $table = "typescollegegroups_days";
  public function day(){
    return $this->belongsTo(Day::class,'day_id');
  }
}