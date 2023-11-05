<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Day;
class TypegroupDay extends Model
{
     protected  $guarded = [];
      protected $table = "typegroups_days";
  public function day(){
    return $this->belongsTo(Day::class,'day_id');
  }
}