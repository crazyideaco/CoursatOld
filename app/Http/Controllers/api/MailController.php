<?php

namespace App\Http\Controllers\api;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
class MailController extends Controller {
   public function basic_email($email) {
       
       $user=\App\User::where('email',$email)->first();
       if($user == null){
           	          	        return response()->json(['status'=>"false",'message_en'=>"غير موجود في الداتا بيز"], 401); 

       }
       $result=Str::random(10);
       $user->password=Hash::make($result);
       $user->save();
       $email=$user->email;
		   $data = array('password'=>$result, 'name'=>$user->name);
   
      Mail::send(['text'=>'mail'], $data, function($message)  use ($email){
         $message->to($email, '')->subject
            ('Verification code for resetting your password');
         $message->from('coursat@crazyideaco.com','CrazyIdea');
      });
	          	        return response()->json(['status'=>"true",'message_en'=>"تم الارسال بنجاح"]); 
   }
   public function html_email() {
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel HTML Testing Mail');
         $message->from('xyz@gmail.com','Virat Gandhi');
      });
      echo "HTML Email Sent. Check your inbox.";
   }
   public function attachment_email() {
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
         $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
         $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
         $message->from('xyz@gmail.com','Virat Gandhi');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }
}


