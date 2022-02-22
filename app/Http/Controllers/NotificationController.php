<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\State;
use FFMpeg;
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
class NotificationController extends Controller
{
   public function __construct()
    {
       $this->middleware(['permission:sendnotification-create'])->only('sendnoty');
        $this->middleware(['permission:sendnotificationbasic-create'])->only('sendnotification');
        $this->middleware(['permission:sendnotificationuniversity-create'])->only('senduniversitynotification');
       $this->middleware(['permission:sendnotificationgeneral-create'])->only('sendgeneralnotification');
    }
  public function storenotification(Request $request){
      	$validator = Validator::make($request->all(), [
        		'title'    => 'required',
        		'text'=>'required',
          'years_id' => 'required'
	    	],[
	    	   'title.required' => 'حقل عنوان الاشعار مطلوب',
	    	   'text.required' => 'حقل نص الاشعار مطلوب',
            'years_id.required' => 'حقل السنوات مطلوب'
	    	    ]);
		if($validator->passes()){
			 if(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1){
      $types = auth()->user()->centertypes->pluck('id')->toArray();
	  $students_ids = Student_Type::whereIn('id',$types)->get()->pluck('student_id')->unique();
	  $students = User::whereIn('id',$students_ids)->get();
      }else if (Auth::user() && Auth::user()->is_student == 2 ){
              $types = auth()->user()->types->pluck('id')->toArray();
	    $students_ids = Student_Type::whereIn('id',$types)->get()->pluck('student_id')->unique();
	  $students = User::whereIn('id',$students_ids)->get();
      } else if(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2){
      $types = auth()->user()->centertypescollege->pluck('id')->toArray();
	  $students_ids = Student_Typecollege::whereIn('id',$types)->get()->pluck('student_id')->unique();
	  $students = User::whereIn('id',$students_ids)->get();
      }else if (Auth::user() && Auth::user()->is_student == 3 ){
              $types = auth()->user()->typescollege->pluck('id')->toArray();
	    $students_ids = Student_Typecollege::whereIn('id',$types)->get()->pluck('student_id')->unique();
	  $students = User::whereIn('id',$students_ids)->get();
      }else if(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 3){
      $types = auth()->user()->centercourses->pluck('id')->toArray();
	  $students_ids = Student_Course::whereIn('id',$types)->get()->pluck('student_id')->unique();
	  $students = User::whereIn('id',$students_ids)->get();
      }else if (Auth::user() && Auth::user()->is_student == 4 ){
              $types = auth()->user()->courses->pluck('id')->toArray();
	    $students_ids = Student_Course::whereIn('id',$types)->get()->pluck('student_id')->unique();
	  $students = User::whereIn('id',$students_ids)->get();
      }else{
			$students = User::where('is_student',1)->where('year_id',$request->years_id)->where('is_visitor',0)->get();
            }
			foreach($students as $user){
				$not = new Notification;
    $not->title = $request->title;
     $not->text = $request->text;
    $not->user_id = $user->id;
    $not->save();
    $to = $user->device_token;
         $data = [
            "to" =>$to,
            'notification'=>[
                'title' => $request->title,
                'body' => $request->text
                ],
            "data" =>[
               'title' => $request->title,
                'body' => $request->text,
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
            }
            return response()->json(['status' => true,'message' => 'تم ارسال الاشعارات بنجاح']);
			
		}else if($validator->fails()){
		 $msg = $validator->messages()->first();
			    return response()->json(['status' => false,'message' => $msg]);
		}
	}public function sendnotification(){
      $stages = Stage::all();
      $years = Year::all();
        return view('dashboard.notifications.sendnotification')->with('stages',$stages)->with('years',$years);
    }
  public function storeuniversitynotification(Request $request){
      	$validator = Validator::make($request->all(), [
        		'title'    => 'required',
        		'text'=>'required',
          'section_id' => 'required'
	    	],[
	    	   'title.required' => 'حقل عنوان الاشعار مطلوب',
	    	   'text.required' => 'حقل نص الاشعار مطلوب',
            'section_id.required' => 'حقل الفرقه مطلوب'
	    	    ]);
		if($validator->passes()){
			 if(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1){
      $types = auth()->user()->centertypes->pluck('id')->toArray();
	  $students_ids = Student_Type::whereIn('id',$types)->get()->pluck('student_id')->unique();
	  $students = User::whereIn('id',$students_ids)->get();
      }else if (Auth::user() && Auth::user()->is_student == 2 ){
              $types = auth()->user()->types->pluck('id')->toArray();
	    $students_ids = Student_Type::whereIn('id',$types)->get()->pluck('student_id')->unique();
	  $students = User::whereIn('id',$students_ids)->get();
      } else if(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2){
      $types = auth()->user()->centertypescollege->pluck('id')->toArray();
	  $students_ids = Student_Typecollege::whereIn('id',$types)->get()->pluck('student_id')->unique();
	  $students = User::whereIn('id',$students_ids)->get();
      }else if (Auth::user() && Auth::user()->is_student == 3 ){
              $types = auth()->user()->typescollege->pluck('id')->toArray();
	    $students_ids = Student_Typecollege::whereIn('id',$types)->get()->pluck('student_id')->unique();
	  $students = User::whereIn('id',$students_ids)->get();
      }else if(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 3){
      $types = auth()->user()->centercourses->pluck('id')->toArray();
	  $students_ids = Student_Course::whereIn('id',$types)->get()->pluck('student_id')->unique();
	  $students = User::whereIn('id',$students_ids)->get();
      }else if (Auth::user() && Auth::user()->is_student == 4 ){
              $types = auth()->user()->courses->pluck('id')->toArray();
	    $students_ids = Student_Course::whereIn('id',$types)->get()->pluck('student_id')->unique();
	  $students = User::whereIn('id',$students_ids)->get();
      }else{
			$students = User::where('is_student',1)->where('section_id',$request->section_id)->where('is_visitor',0)->get();
            }
			foreach($students as $user){
				$not = new Notification;
    $not->title = $request->title;
     $not->text = $request->text;
    $not->user_id = $user->id;
    $not->save();
    $to = $user->device_token;
         $data = [
            "to" =>$to,
            'notification'=>[
                'title' => $request->title,
                'body' => $request->text
                ],
            "data" =>[
               'title' => $request->title,
                'body' => $request->text,
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
            }
            return response()->json(['status' => true,'message' => 'تم ارسال الاشعارات بنجاح']);
			
		}else if($validator->fails()){
		 $msg = $validator->messages()->first();
			    return response()->json(['status' => false,'message' => $msg]);
		}
	}public function senduniversitynotification(){
        return view('dashboard.notifications.senduniversitynotifications')->
     with('subjectscollegs',SubjectsCollege::all())->with('colleges',College::all())->with('divisions',Division::all())->
     with('sections',Section::all())->with('universities',University::all());
    }  public function storegeneralnotification(Request $request){
      	$validator = Validator::make($request->all(), [
        		'title'    => 'required',
        		'text'=>'required',
          'course_id' => 'required'
	    	],[
	    	   'title.required' => 'حقل عنوان الاشعار مطلوب',
	    	   'text.required' => 'حقل نص الاشعار مطلوب',
            'course_id.required' => 'حقل الكورس مطلوب'
	    	    ]);
		if($validator->passes()){
           $course = Course::where('id',$request->course_id)->first();
			$students = $course->studentscourses;
            
			foreach($students as $user){
				$not = new Notification;
    $not->title = $request->title;
     $not->text = $request->text;
    $not->user_id = $user->id;
    $not->save();
    $to = $user->device_token;
         $data = [
            "to" =>$to,
            'notification'=>[
                'title' => $request->title,
                'body' => $request->text
                ],
            "data" =>[
               'title' => $request->title,
                'body' => $request->text,
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
            }
            return response()->json(['status' => true,'message' => 'تم ارسال الاشعارات بنجاح']);
			
		}else if($validator->fails()){
		 $msg = $validator->messages()->first();
			    return response()->json(['status' => false,'message' => $msg]);
		}
	}public function sendgeneralnotification(){
        return view('dashboard.notifications.sendgeneralnotification')->
     with('subs',Sub::all());
    }public function sendnoty(){
    
        return view('dashboard.notifications.sendnoty');
    } public function storenoty(Request $request){
      	$validator = Validator::make($request->all(), [
        		'title'    => 'required',
        		'text'=>'required',
         
	    	],[
	    	   'title.required' => 'حقل عنوان الاشعار مطلوب',
	    	   'text.required' => 'حقل نص الاشعار مطلوب',
          
	    	    ]);
		if($validator->passes()){
      if(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1){
        $types1 = auth()->user()->centertypes->pluck('id')->toArray();
      $types = auth()->user()->centertypes;
      $students_ids = Student_Type::whereIn('type_id',$types1)->get()->pluck('student_id')->unique();
      $students1 = User::whereIn('id',$students_ids)->get();
      $students = $students1->merge(auth()->user()->centerstudents);
        }else if (Auth::user() && Auth::user()->is_student == 2 ){
                $types1 = auth()->user()->types->pluck('id')->toArray();
      $types = auth()->user()->types;
        $students_ids = Student_Type::whereIn('type_id',$types1)->get()->pluck('student_id')->unique();
      $students1 = User::whereIn('id',$students_ids)->get();
       $students = $students1->merge(auth()->user()->centerstudents);
        } else if(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2){
        $types1 = auth()->user()->centertypescollege->pluck('id')->toArray();
         $types = auth()->user()->centertypescollege;
      $students_ids = Student_Typecollege::whereIn('typecollege_id',$types1)->get()->pluck('student_id')->unique();
      $students1= User::whereIn('id',$students_ids)->get();
       $students = $students1->merge(auth()->user()->centerstudents);
        }else if (Auth::user() && Auth::user()->is_student == 3 ){
                 $types1 = auth()->user()->typescollege->pluck('id')->toArray();
        $types = auth()->user()->typescollege;
        $students_ids = Student_Typecollege::whereIn('typecollege_id',$types1)->get()->pluck('student_id')->unique();
      $students1 = User::whereIn('id',$students_ids)->get();
      $students = $students1->merge(auth()->user()->centerstudents);
        }else if(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 3){
        $types1 = auth()->user()->centercourses->pluck('id')->toArray();
       $types = auth()->user()->centercourses;
      $students_ids = Student_Course::whereIn('course_id',$types1)->get()->pluck('student_id')->unique();
      $students1 = User::whereIn('id',$students_ids)->get();
      $students = $students1->merge(auth()->user()->centerstudents);
        }else if (Auth::user() && Auth::user()->is_student == 4 ){
                $types1 = auth()->user()->courses->pluck('id')->toArray();
                $types = auth()->user()->courses;
        $students_ids = Student_Course::whereIn('course_id',$types1)->get()->pluck('student_id')->unique();
      $students1 = User::whereIn('id',$students_ids)->get();
        $students = $students1->merge(auth()->user()->centerstudents);
        }else{
			$students = User::where('is_student',1)->where('is_visitor',0)->get();
            }
          
			foreach($students as $user){
				$not = new Notification;
          $not->title = $request->title;
          $not->text = $request->text;
          $not->user_id = $user->id;
          $not->save();
          $to = $user->device_token;
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
            }
            return response()->json(['status' => true,'message' => 'تم ارسال الاشعارات بنجاح']);
			
		}else if($validator->fails()){
		 $msg = $validator->messages()->first();
			    return response()->json(['status' => false,'message' => $msg]);
		}
	}
}