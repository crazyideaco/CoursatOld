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
class GeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:general-create'])->only('addgeneral');
        $this->middleware(['permission:general-read'])->only('gerenal');
        $this->middleware(['permission:general-update'])->only('editgeneral');
      $this->middleware(['permission:general-delete'])->only('deletegeneral');
    }
   public function addgeneral(){
     return view('dashboard.addgeneral');
 }
 public function storegeneral(Request $request){
     $request->validate([
         'name_ar' => 'required|unique:general',
         'name_en' => 'required|unique:general',
           'image' => 'required|mimes:jpeg,jpg,png,gif',
         ],
         [
        'required' => 'هذا الحقل مطلوب',
	 'unique' => 'هذا القسم موجود من قبل',
        'mimes' => 'هذا الحقل يطلب صوره فقط',
		
             ]);
     $general = new General;
      	if($request->hasFile('image'))
        {
            $image = $request->image;
            $image->move('uploads' ,time(). $image->getClientOriginalName());
            $general->image = time().$request->image->getClientOriginalName();
        }
        $general->category_id = $request->category_id;
        $general->name_ar = $request->name_ar;
        $general->name_en = $request->name_en;
        $general->save();
     return redirect()->route('general');
}
public function general(){
    return view('dashboard.general')->with('generals',General::orderBy('id','Desc')->get());
}public function editgeneral($id){
    return view('dashboard.editgeneral')->with('general',General::where('id',$id)->first());
}
   public function deletegeneral($id){
     $general = General::where('id',$id)->first();
     $general->delete();
     return response()->json(['status' => true]);
 
 }
 public function updategeneral($id,Request $request){
      $request->validate([
         'name_ar' => 'required|unique:general,name_ar,' . $id,
         'name_en' => 'required|unique:general,name_en,' . $id,
          'image' => 'mimes:jpeg,jpg,png,gif',],
         [
        'required' => 'هذا الحقل مطلوب',
          'mimes' => 'هذا الحقل يطلب صوره فقط',
         'unique' => 'هذا القسم موجود من قبل'
             ]);
     $general = General::where('id',$id)->first();
     if($request->hasFile('image'))
        {
		 if(public_path().'/uploads/'.$general->image){
		 $link = public_path().'/uploads/'.$general->image;
       unlink($link);
		 }
            $image = $request->image;
            $image->move('uploads' , time() . $image->getClientOriginalName());
            $general->image = time() . $request->image->getClientOriginalName();
        }
         $general->category_id = $request->category_id;
             $general->name_ar = $request->name_ar;
             $general->name_en = $request->name_en;
        $general->save();
     return redirect()->route('general');
}
}