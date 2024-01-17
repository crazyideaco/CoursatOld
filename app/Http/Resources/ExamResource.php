<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Http\Resources\QuestionResource;
use App\TypeExam;
use App\TypeexamResult;
use App\TypescollegeexamResult;

class ExamResource extends JsonResource
{
    public function toArray($request)
    {
        if (auth()->user()->category_id == 1) {
            $subject = $this->subject->name_ar;
            $exam_result = TypeexamResult::where('student_id', auth()->id())->where('exam_id',$this->id)->firstOrNew();
        } else if (auth()->user()->category_id == 2) {
            $subject = $this->subjectscollege->name_ar;
            $exam_result = TypescollegeexamResult::where('student_id', auth()->id())->where('exam_id',$this->id)->firstOrNew();

        }


        return [


            'id' => $this->id,
            'title' => $this->name,
            'from' => $this->getStartDateTimeAttribute(),//->format('Y-m-d g:i A'),//Carbon::parse($this->date_time)->format('g:i A'),
            'to' => $this->getEndDateTimeAttribute(),//->format('Y-m-d g:i A'),//Carbon::parse($this->date_time)->addMinutes($this->duration_time)->format('g:i A'),
            // 'duration' => intval($this->duration),
            'duration' => intval($this->duration_time),
            'degree' =>  intval($this->score),
            'question_number' => intval($this->question_number),
            'subject' => $subject,
            'lecturer_name' => $this->user ? $this->user->name : '',
            'date_day' => $this->date_day,
            'questions' => QuestionResource::collection($this->questions),
            'result_id' => $exam_result ? $exam_result->id : '',
            'degree' => $exam_result ? intval($exam_result->student_score) : 0,


        ];
    }
}
