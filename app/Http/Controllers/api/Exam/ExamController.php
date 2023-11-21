<?php

namespace App\Http\Controllers\api\Exam;

use App\Http\Controllers\Controller;
use App\Traits\ApiTrait;
use App\TypeExam;
use App\TypeexamResult;
use App\TypescollegeExam;
use App\TypescollegeexamResult;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    use ApiTrait;

    public function fetch_exam_availability(Request $request)
    {
        try {
            $rules = [
                "exam_id" => "required",
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->first(), 400);
            }

            $availability = 0;

            if (auth()->user()->category_id == 1) {
                //  dd(auth()->user()->stutypes->pluck('id'));
                $exam = TypeExam::find($request->exam_id);

                $examresult = TypeexamResult::where('student_id', auth()->id())->where('exam_id',$exam->id)->first();
                if ($examresult) {
                    return response()->json([
                        'status' => false,
                        'message' => "لقد دخلت هذا الامتحان من قبل"
                    ]);
                }
                    $typeexam = new TypeexamResult;
                    $typeexam->student_id = auth()->id();
                    $typeexam->exam_id = $exam->id;
                    $typeexam->exam_score = $exam->score;
                    // $typeexam->student_score = $degree;
                    $typeexam->save();


            } else if (auth()->user()->category_id == 2) {
                $exam = TypescollegeExam::find($request->exam_id);

                $examresult = TypescollegeexamResult::where('student_id', auth()->id())->where('exam_id',$exam->id)->first();
                if ($examresult) {
                    return response()->json([
                        'status' => false,
                        'message' => "لقد دخلت هذا الامتحان من قبل"
                    ]);
                }
                    $typeexam = new TypescollegeexamResult;
                    $typeexam->student_id = auth()->id();
                    $typeexam->exam_id = $exam->id;
                    $typeexam->exam_score = $exam->score;
                    // $typeexam->student_score = $degree;
                    $typeexam->save();

            }

            $student = $exam->students()->where('users.id', auth()->id())->first();

            $from =  $exam->getStartDateTimeAttribute()->format('Y-m-d H:i:s');
            $to = $exam->getEndDateTimeAttribute()->format('Y-m-d H:i:s');
            if ($student) {
                // Student has entered the exam before
                $availability = 0;
                $message = "لقد دخلت هذا الامتحان من قبل";
            } else {
                // Student has not entered the exam before
                if ($from > Carbon::now() ) {
                    // Exam is in the future
                    $availability = 0;
                    $message = "   لم يبدأ هذا الامتحان  غير متاح حاليًا";
                } else if ($to < Carbon::now()) {
                    // Exam is in the past
                    $availability = 0;
                    $message = "هذا الامتحان انتهي و لم يعد متاح ";
                } else {
                    // Exam is not in the future, and student has not entered before
                    $availability = 1;
                    $message = "هذا الامتحان متاح";
                }
            }

            // if ($exam) {
            //     $availability = $exam->students()->where('id', auth()->id())->first() ? 0 : 1; //student_id

            //     if ($exam->date_day > Carbon::now()) { // in the future
            //         $availability = 0;
            //         $message = "هذا الامتحان غير متاح";
            //     }

            //     if ($exam->date_day <= Carbon::now()->day() &&  $exam->date_time > Carbon::now()->time) {
            //         $availability = 1;
            //         $message = "هذا الامتحان متاح";
            //     }

            //     return $this->dataResponse($message, $availability, 200);
            // }

            return $this->dataResponse($message, $availability, 200);

            return $this->errorResponse("هذا الامتحان غير متاح", 200);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }

    }

}//End of controller
