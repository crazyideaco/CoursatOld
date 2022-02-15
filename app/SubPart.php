<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubQuestion;
use App\Sub;
use App\General;
class SubPart extends Model
{
     protected  $guarded = [];
      protected $table = "sub_parts";
  public function questions(){
       return $this->hasMany(SubQuestion::class,'subpart_id');
    }    public function sub(){
          return $this->belongsTo(Sub::class,'sub_id');
      }
      public function general(){
          return $this->belongsTo(General::class,'general_id');
      }
}