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
class UniversityController extends Controller
{
  public function __construct()
    {
        $this->middleware(['permission:universities-create'])->only('adduniversity');
        $this->middleware(['permission:universities-read'])->only('universities');
        $this->middleware(['permission:universities-update'])->only('edituniversity');
      $this->middleware(['permission:universities-delete'])->only('deleteuniversity');
    }
  public function adduniversity(){
    return view('dashboard.adduniversity');
}
public function storeuniversity(Request $request){
    $un = new University;
    $un->name_ar = $request->name_ar;
    $un->name_en = $request->name_en;
    $un->category_id = $request->category_id;
    $un->save();
    return redirect()->route('universities');
}
public function universities(){
    $universities = University::orderBy('created_at','desc')->get();
    return view('dashboard.universities')->with('universities',$universities);
}public function deleteuniversity($id){
    $university = University::where('id',$id)->first();
	$university->delete();
    return response()->json(['status' => true,'message' => 'تم المسح بنجاح']);
}public function edituniversity($id){
  $un = University::where('id',$id)->first();
  return view('dashboard.edituniversity')->with('un',$un);
}
public function updateuniversity($id,Request $request){
$un = University::where('id',$id)->first();  
   $un->name_ar = $request->name_ar;
  $un->name_en = $request->name_en;
  $un->category_id = $request->category_id;
  $un->save();
  return redirect()->route('universities');
}
}