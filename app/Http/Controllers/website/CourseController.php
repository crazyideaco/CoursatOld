<?php
namespace App\Http\Controllers\website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\User;
use App\Http\Requests\Website\Auth\LoginRequest;
use App\Http\Controllers\Controller;
use App\WebsiteStudent;
use PDO;
use App\Type;
use App\Course;
use App\TypesCollege;

class CourseController extends Controller
{
        public function courses(){
         
            $user = auth()->guard("website_student")->user();
            $course_ids = $user->courses->pluck("course_id")->toArray();
            if($user->type == 1){
             $courses = Type::whereIn("id",$course_ids)->get();
            }elseif($user->type == 2){
                $courses = TypesCollege::whereIn("id",$course_ids)->get();
            }
            elseif($user->type == 3){
                $courses = Course::whereIn("id",$course_ids)->get();
            }
            return view('website.courses',compact("courses"));
        }
        public function course_lessons($id){
            $user = auth()->guard("website_student")->user();
            $course_ids = $user->courses->pluck("course_id")->toArray();
            if($user->type == 1){
             $course = Type::where("id",$id)->firstorFail();
             $lessons = $course->subtypes;
            }elseif($user->type == 2){
                $course = TypesCollege::where("id",$id)->firstorFail();
                $lessons = $course->lessons;
            }
            elseif($user->type == 3){
                $course = Course::where("id",$id)->firstorFail();
                $lessons = $course->subtypes;
            }
            return view('website.lessons',compact("lessons"));
        }
}