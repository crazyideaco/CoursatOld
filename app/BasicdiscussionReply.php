<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;
class BasicdiscussionReply extends Model
{
     protected  $guarded = [];
      protected $table = "basicdiscussions_replies";
  public function user(){
    return $this->belongsTo(User::class,"user_id");
  }   public function getCreatedAtAttribute($value)
    {
        Carbon::setLocale('ar');
           $time = Carbon::parse($value);
           return $time->diffForHumans();
    }
      
}