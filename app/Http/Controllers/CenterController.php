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

class CenterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:centers-create'])->only('addcenter');
        $this->middleware(['permission:centers-read'])->only('centers');
        $this->middleware(['permission:centers-update'])->only('editcenter');
        // $this->middleware(['permission:teacher-delete'])->only('destroy');
    }
    public function addcenter()
    {
        return view('dashboard.addcenter')->with('sections', Section::all())
            ->with('states', State::all())->with('colleges', College::all())
            ->with('stages', Stage::all())->with('categories', Category::all());
    }
    public function storecenter(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'password' => 'required',
            'name' => 'required|unique:users',
            'phone' => 'required|unique:users|numeric',
            'image' => 'required|mimes:jpeg,jpg,png,gif',
            //'printsplash' => 'required|mimes:jpeg,jpg,png,gif',
            //   'intro' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi',
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
        $user->email = $request->email;
        $user->is_student = 5;
        $user->code = rand(100, 9999999);
        $user->category_id = $request->category_id;
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
        if ($request->hasFile('cover_image')) {
            $cover_image = $request->cover_image;
            $cover_image->move('uploads', time() . $cover_image->getClientOriginalName());
            $user->cover_image = time() . $request->cover_image->getClientOriginalName();
        }
        if ($request->hasFile('intro')) {
            $intro = $request->intro;
            $intro->move('uploads', time() . '.' . $intro->getClientOriginalExtension());
            $user->intro = time() . '.' . $intro->getClientOriginalExtension();
        }

        $user->save();
        $permissions = Permission::get()->pluck('id');
        if ($permissions) {
            $user->syncPermissions($permissions);
        }
        return response()->json(['success' => 'center added']);
    }
    public function centers()
    {
        return view('dashboard.centers')->with('centers', User::where('is_student', 5)->get());
    }
    public function editcenter($id)
    {
        $center = User::where('id', $id)->first();
        return view('dashboard.editcenter')->with('sections', Section::all())
            ->with('states', State::all())->with('cities', City::all())->with('colleges', College::all())
            ->with('stages', Stage::all())->with('categories', Category::all())->with('center', $center);
    }
    public function updatecenter($id, Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'name' => "required|unique:users,email,$id",
            'phone' => "required|unique:users,phone,$id|numeric",
            'state_id' => 'required',
            'address' => 'required',
            'city_id' => 'required',
            'email' => "required|unique:users,email,$id",
            "category_id" => 'required'
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
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->state_id = $request->state_id;
        $user->city_id = $request->city_id;
        $user->description = $request->description;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->is_student = 5;
        $user->category_id = $request->category_id;
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
            $intro->move('uploads', time() . $intro->getClientOriginalName());
            $user->intro = time() . $request->intro->getClientOriginalName();
        }
        $permissions = Permission::get()->pluck('id');
        if ($permissions) {
            $user->syncPermissions($permissions);
        }
        $user->save();

        return response()->json(['success' => 'center edited']);
    }
}
