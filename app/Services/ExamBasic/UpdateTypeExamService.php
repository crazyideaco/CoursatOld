<?php

namespace App\Services\ExamBasic;

use App\SubjectQuestion;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\TypeExam;
use App\TypeexamQuestion;
use App\TypeexamquestionsAnswer;

class UpdateTypeExamService
{
    public function update(Request $request, $id)
    {


        $exam =  TypeExam::where('id', $id)->first();
        $type = Type::where('id', $exam->type_id)->first();
        $exam->name = $request->name_ar;
        $exam->duration_time = $request->duration_time;

        $exam->date_day = $request->date_day;
        $exam->date_time = $request->date_time;
        
        $exam->end_date = $request->end_date;
        $exam->end_time = $request->end_time;

        $exam->score = $request->totalscore;
        // $exam->type_id = $id;
        $exam->question_number = $request->question_number;
        //   $exam->years_id =$type->years_id;
        //  $exam->subjects_id =$type->subjects_id;
        $exam->user_id = $type->user_id;
        $exam->save();
        if ($request->name) {
            TypeexamQuestion::where('typeexam_id', $id)->delete();
            foreach ($request->name as $key1 => $name) {
                $question = new TypeexamQuestion;
                $question->years_id = $exam->years_id;
                $question->subjects_id = $exam->subjects_id;
                $question->name = $name;
                $question->typeexam_id = $exam->id;
                $question->score = $request->score[$key1];
                $question->question_level = $request->question_level[$key1];
                if ($request->question_image[$key1]) {
                    if (file_exists($request->question_image[$key1])) {
                        $image = $request->question_image[$key1];
                        $image->move('uploads', time() . $image->getClientOriginalName());
                        $question->question_image = time() . $image->getClientOriginalName();
                    } else {
                        $question->question_image = $request->question_image[$key1];
                    }
                }
                $question->save();
                foreach ($request->answer[$key1] as $key => $value) {
                    $questionanswer1 = new TypeexamquestionsAnswer;
                    $questionanswer1->name = $value;
                    if (array_key_exists($key, $request->correct[$key1])) {

                        $questionanswer1->correct = $request->correct[$key1][$key];
                    }
                    $questionanswer1->typeexamquestion_id = $question->id;
                    $questionanswer1->save();
                }
            }
        }
        if ($request->question_id) {
            $questions = SubjectQuestion::whereIn('id', $request->question_id)->get();
            if ($questions) {
                foreach ($questions as $question1) {
                    $question = new TypeexamQuestion;
                    $question->years_id = $question1->years_id;
                    $question->subjects_id = $question1->subjects_id;
                    $question->name = $question1->name;
                    $question->typeexam_id = $exam->id;
                    $question->score = $question1->score;
                    $question->question_level = $question1->question_level;
                    $question->question_image = $question1->question_image;
                    $question->save();
                    foreach ($question1->answers as $answer) {
                        $questionanswer1 = new TypeexamquestionsAnswer;
                        $questionanswer1->name = $answer->name;
                        $questionanswer1->correct = $answer->correct;
                        $questionanswer1->typeexamquestion_id = $question->id;
                        $questionanswer1->save();
                    }
                }
            }
        }
        return response()->json(['success' => 'exam uploaded', 'id' => $exam->type_id]);
    }
}
