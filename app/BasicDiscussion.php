<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\user;
use App\Year;
use App\Tag;
use Carbon\Carbon;
use App\BasicdiscussionReply;
class BasicDiscussion extends Model
{
     protected  $guarded = [];
      protected $table = "basic_discussions";
  public function tags(){
        return $this->belongsToMany(Tag::class, 'basicdiscussions_tags','basicdiscussion_id','tag_id');
    }public function replies(){
    return $this->hasMany(BasicdiscussionReply::class,'basicdiscussion_id');
  }public function user(){
    return $this->belongsTo(User::class,"user_id");
  } public function getCreatedAtAttribute($value)
    {
        Carbon::setLocale('ar');
           $time = Carbon::parse($value);
           return $time->diffForHumans();
    }
      
}