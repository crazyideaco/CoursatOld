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

class StageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:stages-create'])->only('addstage');
        $this->middleware(['permission:stages-read'])->only('stages');
        $this->middleware(['permission:stages-update'])->only('editstage');
        $this->middleware(['permission:stages-delete'])->only('deletestage');
    }
    public function addstage()
    {
        return view('dashboard.addstage');
    }
    public function storestage(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|unique:stages',
            'name_en' => 'required||unique:stages'
        ], [
            'required' => 'هذا الحقل مطلوب',
            'unique' =>  'هذا الاسم موجود'
        ]);
        $stage = new Stage;
        $stage->name_ar = $request->name_ar;
        $stage->name_en = $request->name_en;
        $stage->category_id = $request->category_id;
        $stage->save();
        return redirect()->route('stages');
    }
    public function editstage($id)
    {
        return view('dashboard.editstage')->with('stage', Stage::where('id', $id)->first());
    }
    public function updatestage($id, Request $request)
    {
        $request->validate([
            'name_ar' => 'required|unique:stages,name_ar,' . $id,
            'name_en' => 'required|unique:stages,name_en,' . $id,
        ], [
            'required' => 'هذا الحقل مطلوب',
            'unique' => 'هذا الاسم موجود'
        ]);
        $stage = Stage::where('id', $id)->first();
        $stage->name_ar = $request->name_ar;
        $stage->name_en = $request->name_en;
        $stage->category_id = $request->category_id;
        $stage->save();
        return redirect()->route('stages');
    }
    public function stages()
    {
        return view('dashboard.stages')->with('stages', Stage::all());
    }
    public function deletestage($id)
    {
        $category = Stage::where('id', $id)->first();
        $category->delete();
        return response()->json(['status' => true]);
    }
    
}
