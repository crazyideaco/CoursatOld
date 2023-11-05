<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\State;
use App\Point;
use App\City;
use App\Year;
use App\Subject;
use App\Type;
use App\Subtype;
use App\Video;
use Illuminate\Support\Facades\File;
use App\User;
use App\Offer;
use App\User_Year;
use Illuminate\Validation\Rule;
use App\Category;
use App\Stage;
use App\College;
use App\Division;
use App\Section;
use App\SubjectsCollege;
use App\TypesCollege;
use App\Lesson;
use App\VideosCollege;
use App\General;
use App\Sub;
use App\Course;
use App\Sub_User;
use App\Stage_User;
use App\College_User;
use App\VideosGeneral;
use App\Bouquet;
use App\Notification;
use Session;
use Validator;
use App\Doctor_Subcollege;
use App\Doctor_Division;
use App\Doctor_Section;
use App\University;
use App\Specialbasic;
use App\Specialcollege;
use App\User_Subject;
use App\Center_Teacher;
use App\Center_Doctor;
use App\Center_Lecturer;
use App\Student_Typecollege;
use Illuminate\Support\Facades\Auth;
use Owenoj\LaravelGetId3\GetId3;
use App\Http\Resources\CityResource1;
use QrCode;
use App\Message;
use Carbon\Carbon;
use App\Student_Type;
use App\Paqa;
use App\Paqa_User;
use App\Student_Course;
use Illuminate\Support\Facades\Hash;
class PointController extends Controller
{
   public function points(){
     return view('dashboard.points')->with("point",Point::orderBy('created_at', 'desc')->get());
 }
  public function addpoints($id){
     return view('dashboard.addpoints')->with("point",Point::where('id',$id)->first());
 }
 public function storepoints($id,Request $request){
       $po = Point::where('id',$id)->first();
       $po->point = 1;
        $po->value = $request->value;
        $po->save();
        return redirect()->route('points');
 }public function pointscash(){
    $students = User::where('is_student',1)->whereNotNull("name")->whereNotNull("code")->get();
    return view('dashboard.pointscash')->with('students',$students);
}
public function getstucode($id){
    $student = User::where('id',$id)->first();
    return response()->json($student);
} 
public function getmoney($points){
    $p =Point::first();
    $money = ($points * $p->value) /$p->point; 
    return response()->json($money);
}public function getpoints($money){
    $p =Point::first();
    $point = ($money * $p->point) /$p->value; 
    return response()->json($point);
}
public function storestupoints(Request $request){
    $request->validate([
        'phone' => 'required',
        'points' => 'required|numeric',
        'money' =>'required|numeric' 
        ],
        [
        'required' => 'هذا الحقل مطلوب' ,
        'numeric' => 'هذا الحقل يقبل رقما فقط'
            ]);
    $stu = User::where('phone',$request->phone)->first();
    $point = $stu->points;
    $stu->points = intval($point) + intval($request->points);
    $stu->save();
  	$not = new Notification;
    $not->title ='صرف نقاط'; 
    $not->text = 'تم صرف' .' '. $request->points . ' ' . 'نقاط لك بنجاح ';
    $not->user_id = $stu->id;
    $not->save();
    $to = $stu->device_token;
         $data = [
            "to" =>$to,
            'notification'=>[
                'title' => $not->title,
                'body' => $not->text
                ],
            "data" =>[
               'title' => $not->title,
                'body' => $not->text,
                "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                'type' => 'general'
                ], 
        ];
     $dataString = json_encode($data);
        $headers = [
            'Authorization: key=AAAANEwk9ss:APA91bEuBLaq1kPuYH94OKvkO4EU_-VMrtmnj63KDB-yioNibhvl7bKbJBEQy6IvnuLyMT6AhoBi83vYe5Ds4-UaEzIyZrL9WO7ObUfTk8dIXFMih3upFFjLvPECl2ApuHe_LL2TKu6g',
            'Content-Type: application/json',
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
      $result=curl_exec($ch);
    return redirect()->route('states');
}
}