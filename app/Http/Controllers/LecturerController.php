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

class LecturerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:lecturer-create'])->only('addlecturer');
        $this->middleware(['permission:lecturer-read'])->only('lecturers');
        $this->middleware(['permission:lecturer-update'])->only('editlecturer');
        // $this->middleware(['permission:teacher-delete'])->only('destroy');
    }
    public function addlecturer()
    {
        return view('dashboard.addlecturer')->with('sections', Section::all())
            ->with('states', State::all())->with('generals', General::all());
    }
    public function storelecturer(Request $request)
    {

        $validator =  Validator::make($request->all(), [
            'password' => 'required',
            'name' => 'required|unique:users',
            'phone' => 'required|unique:users|numeric|regex:/(01)[0-9]{9}/',
            'image' => 'required|mimes:jpeg,jpg,png,gif',
            // 'printsplash' => 'required|mimes:jpeg,jpg,png,gif',
            //    'intro' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi',
            'state_id' => 'required',
            'address' => 'required',
            'city_id' => 'required',
            'email' => 'required|unique:users',
            'sub_id' => 'required',
            'sub_id.*' => 'required'
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
        $user->is_student = 4;
        $user->code = rand(10, 999999);
        $user->description = $request->description;
        $user->email = $request->email;
        $user->general_id = $request->general_id;
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
        if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 3) {
            $cu = new Center_Lecturer;
            $cu->center_id = auth()->user()->id;
            $cu->lecturer_id = $user->id;
            $cu->save();
        }
        if ($request->sub_id) {
            foreach ($request->sub_id as $sub_id) {
                $sub_user = new Sub_User;
                $sub_user->user_id = $user->id;
                $sub_user->sub_id = $sub_id;
                $sub_user->save();
            }
        }
        $permissions = Permission::get()->pluck('id');
        if ($permissions) {
            $user->syncPermissions($permissions);
        }
        return response()->json(['success' => 'lecturer added']);
    }
    public function lecturers()
    {
        if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 3) {
            $lecturers = User::where('id', auth()->user()->id)->first()->lecturers;
        } else {
            $lecturers =  User::where('is_student', 4)->get();
        }
        return view('dashboard.lecturers')->with('lecturers', $lecturers);
    }
    public function editlecturer($id)
    {
        $lecturer = User::where('id', $id)->firstOrFail();
        return view('dashboard.editlecturer')->with('sections', Section::all())->with('cities', City::all())->with('subs', Sub::all())
            ->with('states', State::all())->with('generals', General::all())->with('lecturer', $lecturer);
    }
    public function updatelecturer($id, Request $request)
    {

        $validator =  Validator::make($request->all(), [
            'name' => "required|unique:users,email,$id",
            'phone' => "required|unique:users,phone,$id|numeric",
            'state_id' => 'required',
            'address' => 'required',
            'city_id' => 'required',
            'email' => "required|unique:users,email,$id",
            'sub_id' => 'required',
            'sub_id.*' => 'required'
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
        $user =  User::where('id', $id)->first();
        if ($user->password) {
            $user->password = Hash::make($request->password);
        }
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->state_id = $request->state_id;
        $user->city_id = $request->city_id;
        $user->address = $request->address;
        $user->is_student = 4;
        $user->description = $request->description;
        $user->email = $request->email;
        $user->general_id = $request->general_id;
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
        if ($request->hasFile('cover_image')) {
            $cover_image = $request->cover_image;
            $cover_image->move('uploads', time() . $cover_image->getClientOriginalName());
            $user->cover_image = time() . $request->cover_image->getClientOriginalName();
        }
        $user->save();
        if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 3) {
            $cu = new Center_Lecturer;
            $cu->center_id = auth()->user()->id;
            $cu->lecturer_id = $user->id;
            $cu->save();
        }
        if (count($user->subs) > 0) {
            Sub_User::where('user_id', $id)->get()->each(function ($sub) {
                $sub->delete();
            });
        }
        if ($request->sub_id) {
            foreach ($request->sub_id as $sub_id) {
                $sub_user = new Sub_User;
                $sub_user->user_id = $user->id;
                $sub_user->sub_id = $sub_id;
                $sub_user->save();
            }
        }
        $permissions = Permission::get()->pluck('id');
        if ($permissions) {
            $user->syncPermissions($permissions);
        }
        return response()->json(['success' => 'lecturer edited']);
    }
    public function getlecturer($id)
    {
        $usersids = Sub_User::where('sub_id', $id)->pluck('user_id')->toArray();
        if (
            Auth::user() && Auth::user()->is_student == 5 &&
            Auth::user()->category_id == 3
        ) {
            $users1 = User::whereIn('id', $usersids)->get();
            $users2 = User::where('id', auth()->user()->id)->first()->lecturers;
            $users = $users1->intersect($users2);
        } else {
            $users = User::whereIn('id', $usersids)->get();
        }
        $text = "";
        $text .= '<option value="0" selected="selected"  disabled="disabled">اختارالمحاضر</option>';
        foreach ($users as $user) {
            $text .= '<option value="' . $user->id . '">' . $user->name . '</option>';
        }

        return response()->json($text);
    }
}
