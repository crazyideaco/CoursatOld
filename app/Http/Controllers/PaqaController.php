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
class PaqaController extends Controller
{
       public function __construct()
    {
        $this->middleware(['permission:paqas-create'])->only('addpaqas');
        $this->middleware(['permission:paqas-read'])->only('paqas');
        $this->middleware(['permission:paqas-update'])->only('editpaqas');
        $this->middleware(['permission:paqas-delete'])->only('deletepaqas');
    }
    public function paqas(){
     return view('dashboard.paqas')->with("paqa",Paqa::orderBy('created_at', 'desc')->get());
 }
 public function storepaqas(Request $request){
      $po = Paqa::where('name',$request->name)->first();
        if($po !== null){

      return back()->withInput()->withErrors(['name' => 'تم تسجيل الاسم من قبل']);
       }
       else{
        $po = new Paqa;
        $po->name = $request->name;
        $po->name_en = $request->name_en;
        $po->size = $request->size;
        $po->value = $request->value;
        $po->type = $request->type;
        $po->num_users = $request->num_user;
        $po->price = $request->price;
        $po->date = Carbon::now()->format('Y-m-d');

        $po->save();
        
       }
        return redirect()->route('paqas');
 }
  public function editpaqas($id){
     $p = Paqa::where('id',$id)->first();
     return view('dashboard.editpaqas')->with('p',$p);
 } public function updatepaqas(Request $request,$id){

 
        $po =  Paqa::where('id',$id)->first();
        $po->name = $request->name;
        $po->name_en = $request->name_en;
        $po->size = $request->size;
        $po->value = $request->value;
        $po->type = $request->type;
        $po->num_users = $request->num_user;
        $po->price = $request->price;
        $po->date = Carbon::now()->format('Y-m-d');

        $po->save();

        return redirect()->route('paqas');
 }
 
  public function addpaqas(){
     return view('dashboard.addpaqas');
 }public function deletepaqas($id){
    $po =  Paqa::where('id',$id)->first();
    $po->delete();
    return response()->json(['status' => true]);
  }
}