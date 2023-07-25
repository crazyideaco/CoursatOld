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
use App\Http\Resources\QuestionResource;
use App\Http\Resources\SubjectResource;
use App\Http\Resources\ExamResource;
use App\TypescollegeExam;
use App\TypeExam;
use App\SubjectQuestion;
use App\SubjectscollegeQuestion;
use App\TypeexamResult;
use App\TypescollegeexamResult;
use App\SubtypeexamResult;
use App\LessonexamResult;
use App\LessonExam;
use App\SubtypeExam;

class ExamController extends Controller
{
  public function fetch_daily_exams()
  {
    if (auth()->user()->category_id == 1) {
      //  dd(auth()->user()->stutypes->pluck('id'));
      $exams = TypeExam::whereDate('date_day', Carbon::now())->whereIn('type_id', auth()->user()->stutypes->pluck('id'))->get();
    } else if (auth()->user()->category_id == 2) {
      $exams = TypescollegeExam::where('date_day', Carbon::now())->whereIn('typescollege_id', auth()->user()->stutypescollege->pluck('id'))->get();
    }
    return response()->json([
      'status' => true,
      'message' => 'امتحاناتك اليوميه',
      'data' => ExamResource::collection($exams)
    ]);
  }

  /**
   * Fetch exam questions.
   *
   * @param \Illuminate\Http\Request $request The request object.
   * @return \Illuminate\Http\JsonResponse The JSON response.
   */

  /**
   * Fetch exam questions.
   *
   * @param \Illuminate\Http\Request $request The request object.
   * @return \Illuminate\Http\JsonResponse The JSON response.
   */
  public function fetch_exam_questions(Request $request)
  {
    $exam_id = $request->exam_id;
    $user_category_id = auth()->user()->category_id;

    $exam = null;
    if ($user_category_id == 1) {
      $exam = TypeExam::find($exam_id);
      $typeexam =  TypeexamResult::whereExamId($exam_id)->whereStudentId(auth()->id())->first();

      if ($typeexam) {
        return response()->json([
          'status' => false,
          'message' => 'لقد امتحنت هذا الامتحان من قبل'
        ]);
      }

    } else if ($user_category_id == 2) {
      $exam = TypescollegeExam::find($exam_id);
      $typeexam =  TypescollegeExamResult::whereExamId($exam_id)->whereStudentId(auth()->id())->first();

      if ($typeexam) {
        return response()->json([
          'status' => false,
          'message' => 'لقد امتحنت هذا الامتحان من قبل'
        ]);
      }

    }


    if (is_null($exam)) {
      return response()->json([
        'status' => false,
        'message' => 'لا يوجد امتحان بهذا الاسم'
      ]);
    }

    return response()->json([
      'status' => true,
      'message' => 'اسئله الامتحان ',
      'data' => QuestionResource::collection($exam->questions)
    ]);
  }

  public function fetch_new_exams()
  {
    $now = Carbon::now();
    $weekStartDate = Carbon::now()->subDays(7)->format('Y-m-d');
    $weekEndDate = Carbon::now()->format('Y-m-d');
    // dd($weekStartDate,$weekEndDate);
    if (auth()->user()->category_id == 1) {
      $exams = TypeExam::whereBetween('date_day', [$weekStartDate, $weekEndDate])->whereIn('type_id', auth()->user()->stutypes->pluck('id'))->get();
    } else if (auth()->user()->category_id == 2) {
      $exams = TypescollegeExam::whereBetween('date_day', [$weekStartDate, $weekEndDate])->whereIn('typescollege_id', auth()->user()->stutypescollege->pluck('id'))->get();
    }
    return response()->json([
      'status' => true,
      'message' => 'الامتحانات الجديده',
      'data' => ExamResource::collection($exams)
    ]);
  }
  public function fetch_subjects()
  {
    if (auth()->user()->category_id == 1) {
      $subjects = Subject::where('years_id', auth()->user()->year_id)->where("active", 1)->get();
    } else if (auth()->user()->category_id == 2) {
      $subjects = SubjectsCollege::where('section_id', auth()->user()->section_id)->where("active", 1)->get();
    }
    return response()->json([
      'status' => true,
      'message' => 'المواد الجديده',
      'data' => SubjectResource::collection($subjects)
    ]);
  }
  public function build_custom_exam(Request $request)
  {
    $number = $request->questions_number ? $request->questions_number : 10;

    if (auth()->user()->category_id == 1) {
      if ($request->status = 0) {
        $questions = SubjectQuestion::where([['subjects_id', '=', $request->subjects_id], ['public', '=', '1']])->whereBetween('question_level', [0, 4])->get()->take($number);
      } else if ($request->status = 1) {
        $questions = SubjectQuestion::where([['subjects_id', '=', $request->subjects_id], ['public', '=', '1']])->whereBetween('question_level', [4, 7])->get()->take($number);
      } else if ($request->status = 3) {
        $questions = SubjectQuestion::where([['subjects_id', '=', $request->subjects_id], ['public', '=', '1']])->whereBetween('question_level', [7, 10])->get()->take($number);
      } else {
        $questions = SubjectQuestion::where([['subjects_id', '=', $request->subjects_id], ['public', '=', '1']])->get()->take($number);
      }
      return response()->json(['status' => true, 'message' => 'اسئله بنك الاسئله', 'data' => QuestionResource::collection($questions)]);
    } else if (auth()->user()->category_id == 2) {
      if ($request->status = 0) {
        $questions = SubjectscollegeQuestion::where([['subjectscollegepart_id', '=', $request->subjects_id], ['public', '=', '1']])->whereBetween('question_level', [0, 4])->get()->take($number);
      } else if ($request->status = 1) {
        $questions = SubjectscollegeQuestion::where([['subjectscollegepart_id', '=', $request->subjects_id], ['public', '=', '1']])->whereBetween('question_level', [4, 7])->get()->take($number);
      } else if ($request->status = 3) {
        $questions = SubjectscollegeQuestion::where([['subjectscollegepart_id', '=', $request->subjects_id], ['public', '=', '1']])->whereBetween('question_level', [7, 10])->get()->take($number);
      } else {
        $questions = SubjectscollegeQuestion::where([['subjectscollegepart_id', '=', $request->subjects_id], ['public', '=', '1']])->get()->take($number);
      }
      return response()->json(['status' => true, 'message' => 'اسئله بنك الاسئله', 'data' => QuestionResource::collection($questions)]);
    }
  }
  public function sendcourse_exam_result(Request $request)
  {
    $exam_id = $request->exam_id;
    $degree = $request->degree;
    if (auth()->user()->category_id == 1) {
      $exam = TypeExam::where('id', $exam_id)->first();
      if (is_null($exam)) {
        return response()->json([
          'status' => false,
          'message' => 'لا يوجد امتحان بهذا الاسم'
        ]);
      } else {
        $typeexam = new TypeexamResult;
        $typeexam->student_id = auth()->id();
        $typeexam->exam_id = $exam_id;
        $typeexam->exam_score = $exam->score;
        $typeexam->student_id = auth()->id();
        $typeexam->student_score = $degree;
        $typeexam->save();
        return response()->json(['status' => true, 'message' => 'تم ارسال النتيجه بنجاح']);
      }
    } else if (auth()->user()->category_id == 2) {
      $exam = TypescollegeExam::where('id', $exam_id)->first();
      if (is_null($exam)) {
        return response()->json([
          'status' => false,
          'message' => 'لا يوجد امتحان بهذا الاسم'
        ]);
      } else {
        $typeexam = new TypescollegeexamResult;
        $typeexam->student_id = auth()->id();
        $typeexam->exam_id = $exam_id;
        $typeexam->exam_score = $exam->score;
        $typeexam->student_id = auth()->id();
        $typeexam->student_score = $degree;
        $typeexam->save();
        return response()->json(['status' => true, 'message' => 'تم ارسال النتيجه بنجاح']);
      }
    }
  }
  public function sendlesson_exam_result(Request $request)
  {
    $exam_id = $request->exam_id;
    $degree = $request->degree;
    if (auth()->user()->category_id == 1) {
      $exam = SubtypeExam::where('id', $exam_id)->first();
      if (is_null($exam)) {
        return response()->json([
          'status' => false,
          'message' => 'لا يوجد امتحان بهذا الاسم'
        ]);
      } else {
        $typeexam = new SubtypeexamResult;
        $typeexam->student_id = auth()->id();
        $typeexam->exam_id = $exam_id;
        $typeexam->exam_score = $exam->score;
        $typeexam->student_id = auth()->id();
        $typeexam->student_score = $degree;
        $typeexam->save();
        return response()->json(['status' => true, 'message' => 'تم ارسال النتيجه بنجاح']);
      }
    } else if (auth()->user()->category_id == 2) {
      $exam = LessonExam::where('id', $exam_id)->first();
      if (is_null($exam)) {
        return response()->json([
          'status' => false,
          'message' => 'لا يوجد امتحان بهذا الاسم'
        ]);
      } else {
        $typeexam = new LessonexamResult;
        $typeexam->student_id = auth()->id();
        $typeexam->exam_id = $exam_id;
        $typeexam->exam_score = $exam->score;
        $typeexam->student_id = auth()->id();
        $typeexam->student_score = $degree;
        $typeexam->save();
        return response()->json(['status' => true, 'message' => 'تم ارسال النتيجه بنجاح']);
      }
    }
  }
  public function fetch_current_exams()
  {
    $now = Carbon::now();
    if (auth()->user()->category_id == 1) {
      $exams = TypeExam::whereDate('date_day', Carbon::now())->whereIn('type_id', auth()->user()->stutypes->pluck('id'))->get()
        ->each(function ($type) {
          $from = Carbon::parse($type->date_time);
          $to = Carbon::parse($type->date_time)->addMinutes($type->duration_time);
          $now = \Carbon\Carbon::now()->format('H:i:s');
          if ($now >= $from && $now <= $to) {
            return   $type;
          }
        });
    } else if (auth()->user()->category_id == 2) {

      $exams = TypescollegeExam::whereDate('date_day', Carbon::now())->whereIn('typescollege_id', auth()->user()->stutypescollege->pluck('id'))->get()
        ->each(function ($type) {
          $from = Carbon::parse($type->date_time);
          $to = Carbon::parse($type->date_time)->addMinutes($type->duration_time);
          $now = \Carbon\Carbon::now()->format('H:i:s');
          if ($now >= $from && $now <= $to) {
            return   $type;
          }
        });
    }
    return response()->json([
      'status' => true,
      'message' => 'الامتحانات الجايه',
      'data' => ExamResource::collection($exams)
    ]);
  }
  public function periodicexams()
  {

    if (auth()->user()->category_id == 1) {
      //  dd(auth()->user()->stutypes->pluck('id'));
      $exams = TypeExam::whereIn('type_id', auth()->user()->stutypes->pluck('id'))->get();
    } else if (auth()->user()->category_id == 2) {
      $exams = TypescollegeExam::whereIn('typescollege_id', auth()->user()->stutypescollege->pluck('id'))->get();
    }
    return response()->json([
      'status' => true,
      'message' => 'امتحانات دوريه',
      'data' => ExamResource::collection($exams)
    ]);
  }
}
