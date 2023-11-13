<?php

namespace App\Http\Controllers\api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\General;
use Illuminate\Support\Collection;
use App\User;
use App\Sub;
use App\User_Owner;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Type;
use App\Course;
use App\Stage;
use App\University;
use App\TypesCollege;
use App\Student_Type;
use App\Student_Typecollege;
use App\Student_Course;
use App\Subtype;
use App\Student_Subtype;
use App\Student_Lesson;
use App\Lesson;
use App\Course_Rate;
use App\Typecollege_Rate;
use App\Type_Rate;
use App\Subject;
use App\SubjectsCollege;
use App\Message;
use App\VideosGeneral;
use App\Notification;
use Carbon\Carbon;
use App\Http\Resources\LibraryResource;
use App\Http\Resources\SubjectResource;
use App\Http\Resources\ExamResource;
use App\LibraryLesson;
use App\LibrarySubtype;
class LibraryController extends Controller
{
public function add_to_library(Request $request){
     $lesson_id = $request->lesson_id;
     if(auth()->user()->category_id == 1){
        $subtype = Subtype::where('id',$lesson_id)->first();
         if(is_null($subtype)){
              return response()->json(['status' => false,'message' => 'لا يوجد درس بهذا الاسم']);
         
       }else{
      $library = new LibrarySubtype;
         $library->subtype_id = $lesson_id;
         $library->user_id = auth()->id();
         $library->part_points = $subtype->part_points;
         $library->subjects_id = $subtype->subjects_id;
         $library->save();
             return response()->json(['status' => true,'message' => 'تم اضافه الورق الى المكتبه']);
       }
      } else if(auth()->user()->category_id == 2){
          $subtype = Lesson::where('id',$lesson_id)->first();
       if(is_null($subtype)){
        return response()->json(['status' => false,'message' => 'لا يوجد درس بهذا الاسم']);
       }else{      
             $library = new LibraryLesson;
         $library->lesson_id = $lesson_id;
         $library->user_id = auth()->id();
         $library->subcollege_id = $subtype->subjectscollege_id;
           $library->part_points = $subtype->part_points;
         $library->save();
           return response()->json(['status' => true,'message' => 'تم اضافه الورق الى المكتبه']);
       }
      }

}public function fetch_my_library(Request $request){
  
   if(auth()->user()->category_id == 1){
       $parts  = LibrarySubtype::where([['user_id','=',auth()->id()],['subjects_id','=',$request->subjects_id]])->get();
   } else if(auth()->user()->category_id == 2){
       $parts  = LibraryLesson::where([['user_id','=',auth()->id()],['subcollege_id','=',$request->subjects_id]])->get();
   }
      return response()->json(['status' => true,'message' => 'مكتبتك',
                              'data' => LibraryResource::collection($parts)]);
}public function buypart(Request $request){
  $user = auth()->user();
     if(auth()->user()->category_id == 1){
       $part = LibrarySubtype::where([['user_id','=',auth()->id()],['subtype_id','=',$request->lesson_id]])->first();
       if($part){
         if($user->points < $part->part_points){
                    return response()->json(['status' => false,'message' => 'عفوا لا تملك نقاط كافيه   ']);
         }else{
         $part->status = 1;
         $part->save();
         
         $user->points -= $part->part_points;
         $user->save();
         return response()->json(['status' => true,'message' => 'تم شراء المذكره بنجاح']);
         }
       }else{
         return response()->json(['status' => false,'message' => 'عفوا لايوجد مذكره بهذا الاسم فى المكتبه الخاص بك']);
       }
   } else if(auth()->user()->category_id == 2){
       $part  = LibraryLesson::where([['user_id','=',auth()->id()],['lesson_id','=',$request->lesson_id]])->first();
         if($part){
            if($user->points < $part->part_points){
                    return response()->json(['status' => false,'message' => 'عفوا لا تملك نقاط كافيه   ']);
         }else{
         $part->status = 1;
         $part->save();
         $user->points -= $part->part_points;
         $user->save();
         return response()->json(['status' => true,'message' => 'تم شراء المذكره بنجاح']);
            }
       }else{
         return response()->json(['status' => false,'message' => 'عفوا لايوجد مذكره بهذا الاسم فى المكتبه الخاص بك']);
       }
   }
}
}