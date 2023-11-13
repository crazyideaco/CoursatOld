<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use FFMpeg;
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

class LoginController extends Controller
{
    public function startlogin(Request $request)
    {
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            $user = User::where('email', $request->email)->first();
            if ($user->active == 0) {
                return redirect()->back();
            } else {
                if ($user->is_student == 2) {
                    return redirect()->route('editprofile');
                } else if ($user->is_student == 3) {
                    return redirect()->route('editprofile');
                } else if ($user->is_student == 4) {
                    return redirect()->route('editprofile');
                } else if ($user->isAdmin == "admin") {
                    return redirect('/main');
                } else if ($user->is_student == 5 && $user->category_id == 1) {
                    return redirect()->route('editprofile');
                } else if ($user->is_student == 5 && $user->category_id == 2) {
                    return redirect()->route('editprofile');
                } else if ($user->is_student == 5 && $user->category_id == 3) {
                    return redirect()->route('editprofile');
                } else {
                    return redirect()->back();
                }
            }
        } else {
            return redirect()->back();
        }
    }
    public function logoutall()
    {

        auth()->logout();
        return redirect()->route("dashlogin");
    }
    public function logoutallbasic()
    {

        auth()->logout();
        return redirect()->route("dashlogin");
    }
    public function dashlogin()
    {
        return view('dashboard.dashlogin');
    }
}
