<?php

namespace App\Services\ExamCollege;

use App\SubjectscollegeQuestion;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\TypesCollege;
use App\TypescollegeExam;
use App\TypescollegeexamquestionAnswer;
use App\TypescollegeexamsQuestion;

class UpdateTypesCollegeExamService
{
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $exam =  TypescollegeExam::where('id', $id)->first();
        $type = TypesCollege::where('id', $exam->typescollege_id)->first();
        $exam->user_id = $type->doctor_id;
        $exam->name = $request->name_ar;
        $exam->duration_time = $request->duration_time;

        $exam->date_day = $request->date_day;
        $exam->date_time = $request->date_time;


        $exam->end_date = $request->end_date;
        $exam->end_time = $request->end_time;

        $exam->score = $request->totalscore;
        $exam->typescollege_id = $type->id;
        $exam->question_number = $request->question_number;
        $exam->university_id = $type->university_id;
        $exam->college_id = $type->college_id;
        $exam->division_id  = $type->division_id;
        $exam->section_id = $type->section_id;
        $exam->subjectscollege_id  = $type->subjectscollege_id;
        $exam->save();
        if ($request->name) {
            TypescollegeexamsQuestion::where('typescollegeexam_id', $exam->id)->delete();
            foreach ($request->name as $key1 => $name) {
                $question = new TypescollegeexamsQuestion;
                $question->university_id = $type->university_id;
                $question->college_id = $type->college_id;
                $question->division_id  = $type->division_id;
                $question->section_id = $type->section_id;
                $question->subjectscollege_id  = $type->subjectscollege_id;
                $question->typescollege_id  = $type->id;
                $question->name = $name;
                $question->typescollegeexam_id = $exam->id;
                $question->score = $request->score[$key1];
                $question->question_level = $request->question_level[$key1];
                if ($request->question_image[$key1]) {
                    if (file_exists($request->question_image[$key1])) {
                        $image = $request->question_image[$key1];
                        $image->move('uploads', time() . $image->getClientOriginalName());
                        $question->question_image = time() . $image->getClientOriginalName();
                    }
                }
                $question->save();
                foreach ($request->answer[$key1] as $key => $value) {
                    $questionanswer1 = new TypescollegeexamquestionAnswer;
                    $questionanswer1->name = $value;
                    if (array_key_exists($key, $request->correct[$key1])) {

                        $questionanswer1->correct = $request->correct[$key1][$key];
                    }
                    $questionanswer1->typescollegeexamquestion_id  = $question->id;
                    $questionanswer1->save();
                }
            }
            if ($request->question_id) {
                $questions = SubjectscollegeQuestion::whereIn('id', $request->question_id)->get();
                if ($questions) {
                    foreach ($questions as $question1) {
                        $question = new TypescollegeexamsQuestion;
                        $question->university_id = $question1->university_id;
                        $question->college_id = $question1->college_id;
                        $question->division_id  = $question1->division_id;
                        $question->section_id = $question1->section_id;
                        $question->subjectscollege_id  = $question1->subjectscollege_id;
                        //  $question->typescollege_id  = $type->id;
                        $question->name = $question1->name;
                        $question->typescollegeexam_id = $exam->id;
                        $question->score = $question1->score;
                        $question->question_level = $question1->question_level;

                        $question->question_image = $question1->question_image;

                        $question->save();
                        foreach ($question1->answers as $answer) {
                            $questionanswer1 = new TypescollegeexamquestionAnswer;
                            $questionanswer1->name = $answer->name;
                            $questionanswer1->correct = $answer->correct;
                            $questionanswer1->typescollegeexamquestion_id  = $question->id;
                            $questionanswer1->save();
                        }
                    }
                }
            }
        }

        return response()->json(['success' => 'exam uploaded', 'id' => $exam->typescollege_id]);
    }
}
