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
use App\Models\Permission;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:teachers-create'])->only('addteacher');
        $this->middleware(['permission:teachers-read'])->only('teachers');
        $this->middleware(['permission:teachers-update'])->only('editteacher');
        // $this->middleware(['permission:teacher-delete'])->only('destroy');
    }
    public function addteacher()
    {
        return view('dashboard.addteacher')->with('subjects', Subject::all())->with('years', Year::all())->with('states', State::all())->with('stages', Stage::all());
    }
    public function storeteacher(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'password' => 'required',
            'name' => 'required|unique:users',
            'phone' => 'required|unique:users|numeric|regex:/(01)[0-9]{9}/',
            'image' => 'required|mimes:jpeg,jpg,png,gif',
            // 'printsplash' => 'required',
            //      'intro' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi',
            'state_id' => 'required',
            'address' => 'required',
            'city_id' => 'required',
            'email' => 'required|unique:users',
        ], [
            'required' => 'هذا الحقل مطلوب',
            'mimes' =>  ' هذا الحقل يقبل صوره فقط',
            'phone.numeric' => ' رقم الهاتف يقبل رقما فقط',
            'phone.unique' => 'هذا الرقم  مستخدم من قبل',
            'email.unique' => ' هذا الايميل موجود من قبل',
            'name.unique' => 'اسم المستخدم موجود من  قبل ',
            'mimetypes' => 'هذا الحقل يقبل فيديو فقط'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $user = new User;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->state_id = $request->state_id;
        $user->city_id = $request->city_id;
        $user->address = $request->address;
        $user->stage_id = $request->stage_id;
        $user->is_student = 2;
        $user->code = rand(100, 999999);
        $user->description = $request->description;
        $user->email = $request->email;
        if ($request->hasFile('printsplash')) {
            $printsplash = $request->printsplash;
            $printsplash->move('uploads', time() . $printsplash->getClientOriginalName());
            $user->printsplash = time() . $request->printsplash->getClientOriginalName();
        }
        if ($request->hasFile('cover_image')) {
            $cover_image = $request->cover_image;
            $cover_image->move('uploads', time() . $cover_image->getClientOriginalName());
            $user->cover_image = time() . $request->cover_image->getClientOriginalName();
        }
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image->move('uploads', time() . $image->getClientOriginalName());
            $user->image = time() . $request->image->getClientOriginalName();
        }
        if ($request->hasFile('intro')) {
            $intro = $request->intro;
            $intro->move('uploads', time() . '.' . $intro->getClientOriginalExtension());
            $user->intro = time() . '.' . $intro->getClientOriginalExtension();
        }
        $user->save();
        if (Auth::user() && Auth::user()->is_student == 5 && Auth()->user()->category_id == 1) {
            $cu = new Center_Teacher;
            $cu->center_id = auth()->user()->id;
            $cu->teacher_id = $user->id;
            $cu->save();
        }
        if ($request->year_id) {
            foreach ($request->year_id as  $y) {
                $useryear = new User_Year;
                $useryear->year_id = $y;
                $useryear->user_id = $user->id;
                $useryear->save();
            }
        }
        if ($request->subject_id) {
            foreach ($request->subject_id as  $y) {
                $us = new User_Subject;
                $us->subject_id = $y;
                $us->user_id = $user->id;
                $us->save();
            }
        }
        $permissions = Permission::get()->pluck('id');
        if ($permissions) {
            $user->syncPermissions($permissions);
        }
        return response()->json(['success' => 'teacher added']);
    }
    public function teachers()
    {
        if (Auth::user() && Auth::user()->is_student == 5 && Auth()->user()->category_id == 1) {
            $teachers = User::where('id', auth()->user()->id)->first()->teachers;
        } else {
            $teachers = User::where('is_student', 2)->orderBy('created_at', 'desc')->get();
        }
        return view('dashboard.teachers')->with('teachers', $teachers);
    }
    public function editteacher($id)
    {
        $teacher = User::where('id', $id)->firstOrFail();
        return view('dashboard.editteacher')->with('subjects', Subject::all())->with('years', Year::all())->with('states', State::all())->with('stages', Stage::all())->with('teacher', $teacher)->with('cities', City::all());
    }
    public function updateteacher($id, Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'name' => "required|unique:users,name,$id",
            'phone' => "required|unique:users,phone,$id|numeric",
            'state_id' => 'required',
            'address' => 'required',
            'city_id' => 'required',
            'email' => "required|unique:users,email,$id",
        ], [
            'required' => 'هذا الحقل مطلوب',
            'mimes' =>  ' هذا الحقل يقبل صوره فقط',
            'phone.numeric' => ' رقم الهاتف يقبل رقما فقط',
            'phone.unique' => 'هذا الرقم  مستخدم من قبل',
            'email.unique' => ' هذا الايميل موجود من قبل',
            'name.unique' => 'اسم المستخدم موجود من  قبل ',
            'mimetypes' => 'هذا الحقل يقبل فيديو فقط'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $user = User::where('id', $id)->first();
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->state_id = $request->state_id;
        $user->city_id = $request->city_id;
        $user->address = $request->address;
        $user->stage_id = $request->stage_id;
        $user->is_student = 2;
        $user->description = $request->description;
        $user->email = $request->email;
        if ($request->hasFile('cover_image')) {
            $cover_image = $request->cover_image;
            $cover_image->move('uploads', time() . $cover_image->getClientOriginalName());
            $user->cover_image = time() . $request->cover_image->getClientOriginalName();
        }
        if ($request->hasFile('printsplash')) {
            $printsplash = $request->printsplash;
            $printsplash->move('uploads', time() . $printsplash->getClientOriginalName());
            $user->printsplash = time() . $request->printsplash->getClientOriginalName();
        }
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image->move('uploads', time() . $image->getClientOriginalName());
            $user->image = time() . $request->image->getClientOriginalName();
        }
        if ($request->hasFile('intro')) {
            $intro = $request->intro;
            $intro->move('uploads', time() . $intro->getClientOriginalName());
            $user->intro = time() . $request->intro->getClientOriginalName();
        }
        $user->save();
        /* if(Auth::user() && Auth::user()->is_student == 5 && Auth()->user()->category_id == 1){
          $cu = new Center_Teacher;
          $cu->center_id = auth()->user()->id;
          $cu->teacher_id = $user->id;
          $cu->save();
       }*/
        if (count($user->years) > 0) {
            User_Year::where('user_id', $id)->get()->each(function ($sub) {
                $sub->delete();
            });
        }
        if ($request->year_id) {
            foreach ($request->year_id as  $y) {
                $useryear = new User_Year;
                $useryear->year_id = $y;
                $useryear->user_id = $id;
                $useryear->save();
            }
        }
        if (count($user->subjects) > 0) {
            User_Subject::where('user_id', $id)->get()->each(function ($sub) {
                $sub->delete();
            });
        };
        if ($request->subject_id) {
            foreach ($request->subject_id as  $y) {
                $us = new User_Subject;
                $us->subject_id = $y;
                $us->user_id = $id;
                $us->save();
            }
        }
        $permissions = Permission::get()->pluck('id');
        if ($permissions) {
            $user->syncPermissions($permissions);
        }
        return response()->json(['success' => 'teacher edited']);
    }
    public function getteacher($id)
    {
        if (
            Auth::user() && Auth::user()->is_student == 5 &&
            Auth::user()->category_id == 1
        ) {
            $users = User::where('center_id', auth()->user()->id)->where('subject_id', $id)->get();
            $users1 = Subject::where('id', $id)->first()->teachers;
            $users2 = User::where('id', auth()->user()->id)->first()->teachers;
            $users = $users1->intersect($users2);
            $types = Type::where('subjects_id', $id)->where('center_id', auth()->user()->id)->get();
        } else if (Auth::user() && Auth::user()->is_student == 2) {
            $users = User::all();
            $types = Type::where('subjects_id', $id)->where('user_id', auth()->user()->id)->get();
        } else {
            $users = Subject::where('id', $id)->first()->teachers;
            $types = Type::where('subjects_id', $id)->get();
        }
        $text = "";
        $text .= '<option value="0"  selected="selected" disabled>اختر المدرس</option>';
        foreach ($users as $user) {
            $text .= '<option value="' . $user->id . '">' . $user->name . '</option>';
        }
        $text1 = "";
        $text1 .= '<option value="0" selected="selected"   disabled>اختر قسم رئيسى</option>';
        foreach ($types as $type) {
            $text1 .= '<option value="' . $type->id . '">' . $type->name_ar . '</option>';
        }

        return response()->json([$text, $text1]);
    }

    public function getSubject_teacher($id){
        $users = Subject::where('id', $id)->first()->teachers;
        $text = "";
        foreach ($users as $user) {
            $text .= '<option value="' . $user->id . '">' . $user->name . '</option>';
        }
        return response()->json($text);
    }

    public function getSubject_teachercollege($id){
        $users = SubjectsCollege::where('id', $id)->first()->teachers;
        $text = "";
        foreach ($users as $user) {
            $text .= '<option value="' . $user->id . '">' . $user->name . '</option>';
        }
        return response()->json($text);
    }
}
