<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use Carbon\Carbon;
class Message extends Model
{
     protected  $guarded = [];
      protected $table = "messages";
	public function user(){
	return $this->belongsTo(User::class,'user_id');}

	public function getdate(){
		Carbon::setLocale('ar');
            $time= Carbon::parse($this->created_at);
		return $time->diffForHumans();
	}
}
