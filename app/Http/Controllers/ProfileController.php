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

class ProfileController extends Controller
{
    public function edityourinformation()
    {
        $states = State::all();
        $cities = City::all();
        return view('dashboard.edityourinformation')->with('states', $states)->with('cities', $cities);
    }
    public function storeyourinformation(Request $request)
    {

        $request->validate([

            //    'image' => 'mimes:jpeg,jpg,png,gif,svg',
            //   'printsplash' => 'mimes:jpeg,jpg,png,gif,svg',
            //    'intro' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi',
            //  'state_id' => 'required',
            //   'address' => 'required',
            //  'city_id' => 'required',
        ], [
            'required' => 'هذا الحقل مطلوب',
            'mimes' =>  ' هذا الحقل يقبل صوره فقط',

            'mimetypes' => 'هذا الحقل يقبل فيديو فقط'
        ]);

        $user = auth()->user();
        $user->state_id = $request->state_id;
        $user->city_id = $request->city_id;
        $user->address = $request->address;
        $user->description = $request->description;

        if ($request->hasFile('printsplash')) {

            if ($user->printsplash) {
                $link = public_path() . '/uploads/' . $user->printsplash;
                File::delete($link);
            }
            $printsplash = $request->printsplash;
            $printsplash->move('uploads', time() . $printsplash->getClientOriginalName());
            $user->printsplash = time() . $request->printsplash->getClientOriginalName();
            $user->save();
        }
        if ($request->hasFile('cover_image')) {
            if ($user->image) {
                $link = public_path() . '/uploads/' . $user->cover_image;
                File::delete($link);
            }
            $cover_image = $request->cover_image;
            $cover_image->move('uploads', time() . $cover_image->getClientOriginalName());
            $user->cover_image = time() . $request->cover_image->getClientOriginalName();
        }
        if ($request->hasFile('image')) {
            if ($user->image) {
                $link = public_path() . '/uploads/' . $user->image;
                File::delete($link);
            }
            $image = $request->image;
            $image->move('uploads', time() . $image->getClientOriginalName());
            $user->image = time() . $request->image->getClientOriginalName();
            $user->save();
        }
        if ($request->hasFile('intro')) {
            if ($user->intro) {
                $link = public_path() . '/uploads/' . $user->intro;
                File::delete($link);
            }
            $intro = $request->intro;
            $intro->move('uploads', time() . $intro->getClientOriginalName());
            $user->intro = time() . $request->intro->getClientOriginalName();
            $user->save();
        }

        $user->save();
        return response()->json(['success' => 'profile updated sucessfully']);
        //return redirect()->back()->with('success','تم تعديل معلوماتك بنجاح');
    }
    public function editprofile()
    {
        return view('dashboard.editprofile');
    }
    public function updateprofile(Request $request)
    {
        $id = auth()->id();
        $validator = Validator::make($request->all(), [
            'phone' => "unique:users,phone,$id|regex:/(01)[0-9]{9}/",
            'email' => "unique:users,email,$id|email",
            'name' => 'required'
        ], [
            "phone.unique" => "هذا الهاتف موجود من قبل",
            "email.unique" => "هذا الايميل موجود من قبل",
        ]);
        if ($validator->passes()) {
            $user = auth()->user();
            $user->phone = $request->phone;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->description = $request->description;
            $user->save();
            return response()->json(['status' => true]);
        } else {
            $msg = $validator->messages()->first();
            return response()->json(['status' => false, 'message' => $msg]);
        }
    }
    public function editpassword()
    {
        return view('dashboard.editpassword');
    }
    public function updatepassword(Request $request)
    {
        $id = auth()->id();
        $validator = Validator::make($request->all(), [
            'password' => "required|min:6",
        ], [
            "password.required" => "كلمه السر مطلوبه",
            "min" => 'كلمه السر يحب الا تقل عن 6 ارقام'
        ]);
        if ($validator->passes()) {
            $user = auth()->user();
            $user->password =  Hash::make($request->password);
            $user->save();
            return response()->json(['status' => true]);
        } else {
            $msg = $validator->messages()->first();
            return response()->json(['status' => false, 'message' => $msg]);
        }
    }
    public function lecturerprofile($id)
    {
        return view('dashboard.lecturerprofile')->with('id', $id);
    }
    public function studentprofile($id)
    {
        return view('dashboard.students.show')->with('id', $id);
    }
    public function teacherprofile($id)
    {
        return view('dashboard.teacherprofile')->with('id', $id);
    }
    public function centerprofile($id)
    {
        return view('dashboard.centerprofile')->with('id', $id);
    }
    public function doctorprofile($id)
    {
        return view('dashboard.doctorprofile')->with('id', $id);
    }
}
