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
use App\College;
use App\Section;
use App\Division;
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
use App\Http\Resources\QuestionResource;
use App\Http\Resources\ExamResource;
use App\Http\Resources\DiscussionResource;
use App\Http\Resources\LiveLessonResource;
use App\Http\Resources\ReplyResource;
use App\TypescollegeExam;
use App\TypeExam;
use App\Year;
use App\SkipsubtypeExam;
use App\SkiplessonExam;
use App\LessonExam;
use App\SubtypeExam;
use App\GroupscourseLivelesson;
use App\GroupstypesLivelessons;
use App\GroupstypescollegeLivelesson;
use App\SubtypeStudentattendance;
use App\LessonStudentattendance;
class SkipLessonController extends Controller
{
  public function fetch_lesson_exam(Request $request){
         if(auth()->user()->category_id == 1){
        $exam = SubtypeExam::where('subtype_id',$request->lesson_id)->latest()->first();
      } else if(auth()->user()->category_id == 2){
       $exam = LessonExam::where('lesson_id',$request->lesson_id)->latest()->first();
         }
    if(is_null($exam)){
        return response()->json([
      'status' => false,
    'message' => 'لا يوجد امتحانات فى الدرس',
    ]);

  }
    else{
    return response()->json([
      'status' => true,
    'message' => 'امتحانات الدرس ',
    'data' =>new ExamResource($exam)]);
    }
  }public function fetch_exam_lesson_questions(Request $request){
    $exam_id = $request->exam_id;
      if(auth()->user()->category_id == 1){
        $exam = SubtypeExam::where('id',$exam_id)->first();
      } else if(auth()->user()->category_id == 2){
       $exam = LessonExam::where('id',$exam_id)->first();
      }
    if(is_null($exam)){
       return response()->json([
      'status' => false,
    'message' => 'لا يوجد امتحان بهذا الاسم']);
    }else{
    return response()->json([
      'status' => true,
    'message' => 'اسئله الامتحان ',
    'data' => QuestionResource::collection($exam->questions)]);
    }
  }public function skip_lesson_exam(Request $request){
     if(auth()->user()->category_id == 1){
        $exam = SubtypeExam::where('subtype_id',$request->lesson_id)->latest()->first();
       if($exam){
         $skip = new SkipsubtypeExam;
         $skip->user_id = auth()->id();
         $skip->subjects_id = $exam->subjects_id;
         $skip->exam_id = $exam->id;
         $skip->save();
       }
      } else if(auth()->user()->category_id == 2){
       $exam = LessonExam::where('lesson_id',$request->lesson_id)->latest()->first();

         if($exam){
         $skip = new SkiplessonExam;
         $skip->user_id = auth()->id();
         $skip->subcollege_id  = $exam->subjectscollege_id;
         $skip->exam_id = $exam->id;
         $skip->save();
       }
         }
    if(is_null($exam)){
        return response()->json([
      'status' => false,
    'message' => 'لا يوجد امتحانات فى الدرس',
    ]);

  }
    else{
    return response()->json([
      'status' => true,
    'message' => 'تم تخطى الامتحان بنجاح',
    ]);
    }
  }public function archived_exams_pre_lessons(){
     if(auth()->user()->category_id == 1){
      $exam_ids = SkipsubtypeExam::where('user_id',auth()->id())->get()->pluck('exam_id');
        $exams = SubtypeExam::whereIn('id',$exam_ids)->get();

      } else if(auth()->user()->category_id == 2){
        $exam_ids = SkiplessonExam::where('user_id',auth()->id())->get()->pluck('exam_id');
        $exams = LessonExam::whereIn('id',$exam_ids)->get();
     }
      return response()->json([
      'status' => true,
    'message' => 'امتحانات الدرس ',
    'data' => ExamResource::collection($exams)]);
  }public function fetch_live_lessons(Request $request){

    $group_id = $request->group_id;
    if($group_id){
      if(auth()->user()->category_id == 1){
        $lessons = GroupstypesLivelessons::where('grouptype_id',$group_id)->get();
      } else if(auth()->user()->category_id == 2){
        $lessons = GroupstypescollegeLivelesson::where('grouptypescollege_id',$group_id)->get();
     }else{
        $lessons = GroupscourseLivelesson::where('groupcourse_id',$group_id)->get();
      }
    }else{
      if(auth()->user()->category_id == 1){
        $lessons = GroupstypesLivelessons::where('years_id',auth()->user()->year_id)->get();
      } else if(auth()->user()->category_id == 2){
        $lessons = GroupstypescollegeLivelesson::where('section_id',auth()->user()->section_id)->get();
     }
    }
    return response()->json([
      'status' => true,
    'message' => ' دروس اللايف ',
    'data' => LiveLessonResource::collection($lessons)]);
  }public function send_attendance(Request $request){
       if(auth()->user()->category_id == 1){
         $subtype = Subtype::where('id',$request->lesson_id)->first();
         $LessonStudentattendance = SubtypeStudentattendance::where("subtype_id",$request->lesson_id)->whereStudentId(auth()->id())->first();
         if ($LessonStudentattendance) {
            return response()->json([
              'status' => false,
              'message' => 'لقد حضرت هذا الدرس من قبل'
            ]);
          }
         if($subtype){
     $subtypestudent = new SubtypeStudentattendance;
     $subtypestudent->student_id = auth()->id();
     $subtypestudent->subtype_id = $request->lesson_id;
     $subtypestudent->attendance = 1;
     $subtypestudent->save();
      return response()->json(['status' => true,'message' => 'تم تحضير الطالب بنجاح']);
         }else{
             return response()->json(['status' => false,'message' => 'لا يوجد حصه بهذا الاسم ']);
         }

      } else if(auth()->user()->category_id == 2){
                 $subtype = Lesson::where('id',$request->lesson_id)->first();
                 $LessonStudentattendance = LessonStudentattendance::where("lesson_id",$request->lesson_id)->whereStudentId(auth()->id())->first();
                 if ($LessonStudentattendance) {
                    return response()->json([
                      'status' => false,
                      'message' => 'لقد حضرت هذا الدرس من قبل'
                    ]);
                  }
         if($subtype){
     $subtypestudent = new LessonStudentattendance;
     $subtypestudent->student_id = auth()->id();
     $subtypestudent->lesson_id = $request->lesson_id;
     $subtypestudent->attendance = 1;
     $subtypestudent->save();
      return response()->json(['status' => true,'message' => 'تم تحضير الطالب بنجاح']);
         }else{
             return response()->json(['status' => false,'message' => 'لا يوجد حصه بهذا الاسم ']);
         }
     }
  }
}
