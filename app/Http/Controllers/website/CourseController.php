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
            $course_ids = $user->courses->pluck("id")->toArray();
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
}