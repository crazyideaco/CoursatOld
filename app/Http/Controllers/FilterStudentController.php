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
use App\TypeexamResult;
use App\TypescollegeexamResult;

class FilterStudentController extends Controller
{
    public function filter_basic_userstudents(Request $request)
    {
        $year_id = $request->years_id;
        if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1) {
            $types1 = auth()->user()->centertypes->pluck('id')->toArray();
            $types = auth()->user()->centertypes;
            $students_ids = Student_Type::whereIn('type_id', $types1)->get()->pluck('student_id')->unique();
            $students1 = User::whereIn('id', $students_ids)->get();
            $students = $students1->merge(auth()->user()->centerstudents);
        } else if (Auth::user() && Auth::user()->is_student == 2) {
            $types1 = auth()->user()->types->pluck('id')->toArray();
            $types = auth()->user()->types;
            $students_ids = Student_Type::whereIn('type_id', $types1)->get()->pluck('student_id')->unique();
            $students1 = User::whereIn('id', $students_ids)->get();
            $students = $students1->merge(auth()->user()->centerstudents);
        } else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2) {
            $types1 = auth()->user()->centertypescollege->pluck('id')->toArray();
            $types = auth()->user()->centertypescollege;
            $students_ids = Student_Typecollege::whereIn('typecollege_id', $types1)->get()->pluck('student_id')->unique();
            $students1 = User::whereIn('id', $students_ids)->get();
            $students = $students1->merge(auth()->user()->centerstudents);
        } else if (Auth::user() && Auth::user()->is_student == 3) {
            $types1 = auth()->user()->typescollege->pluck('id')->toArray();
            $types = auth()->user()->typescollege;
            $students_ids = Student_Typecollege::whereIn('typecollege_id', $types1)->get()->pluck('student_id')->unique();
            $students1 = User::whereIn('id', $students_ids)->get();
            $students = $students1->merge(auth()->user()->centerstudents);
        } else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 3) {
            $types1 = auth()->user()->centercourses->pluck('id')->toArray();
            $types = auth()->user()->centercourses;
            $students_ids = Student_Course::whereIn('course_id', $types1)->get()->pluck('student_id')->unique();
            $students1 = User::whereIn('id', $students_ids)->get();
            $students = $students1->merge(auth()->user()->centerstudents);
        } else if (Auth::user() && Auth::user()->is_student == 4) {
            $types1 = auth()->user()->courses->pluck('id')->toArray();
            $types = auth()->user()->courses;
            $students_ids = Student_Course::whereIn('course_id', $types1)->get()->pluck('student_id')->unique();
            $students1 = User::whereIn('id', $students_ids)->get();
            $students = $students1->merge(auth()->user()->centerstudents);
        }


        $students = $students->when($year_id != null,function($q) use($year_id){
           
            return $q->where('year_id', $year_id);
                });
        $text = "";
        foreach ($students as $student) {
        $text .='<tr id="s'.$student->id.'">

        <th>'.$student->id.'</th>
        <td scope="col" class="text-center"><a href="'.route('studentprofile',$student->id).'">'.$student->name.'</a></td>
        <td scope="col" class="text-center">'.$student->code.'</td>
        <td scope="col" class="text-center">'.$student->phone.'</td>';
        if($student->year_id != null){
        $text .='<td scope="col" class="text-center">
            <ul>';
                if($student->stutypes){
                foreach($student->stutypes as $type){
                    $text .='<li style="font-size:14px;">'.$type->name_ar.'</li>';

                }
            }
            $text .='</ul>
        </td>';
        }
        elseif($student->university_id != null){
        $text .='<td scope="col" class="text-center">
            <ul>';
                if($student->stutypescollege){
                foreach($student->stutypescollege as $typecollege){
                $text .='<li style="font-size:14px;">'.$typecollege->name_ar.'</li>';
                }
            }
            $text .='</ul>

        </td>';
        }
        else{
        $text .='<td scope="col" class="text-center">


        </td>';
        }
    



   $text .='</tr>';
        }
        return response()->json(['status' => true, 'data' => $text]);
    }
}
