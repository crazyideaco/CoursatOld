<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;
class CollegediscussionReply extends Model
{
     protected  $guarded = [];
      protected $table = "collegediscussions_replies";
  public function user(){
    return $this->belongsTo(User::class,"user_id");
  }
       public function getCreatedAtAttribute($value)
    {
        Carbon::setLocale('ar');
           $time = Carbon::parse($value);
           return $time->diffForHumans();
    }
}