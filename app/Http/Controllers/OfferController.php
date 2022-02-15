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
class OfferController extends Controller
{
    public function __construct()
    {
       $this->middleware(['permission:offers-create'])->only('addoffer');
        $this->middleware(['permission:offers-read'])->only('offers');
        $this->middleware(['permission:offers-update'])->only('editoffer');
       $this->middleware(['permission:offers-delete'])->only('deleteoffer');
    }
   public function offers(){
       if(auth()->user() && auth()->user()->isAdmin == 'admin'){
         $offers = Offer::where('center_id',NULL)->get();
       }
   elseif(Auth::user() &&Auth::user()->is_student == 5){
     $offers = Offer::where('center_id',auth()->id())->get();
   }
     return view('dashboard.offers')->with('offers',$offers);
 }
 public function addoffer(){
     return view('dashboard.addoffer');
 }
 public function storeoffer(Request $request){
	 $request->validate([
		 'image' => 'required|mimes:jpeg,jpg,png,gif',
	 ],[
	'required' => 'حقل الصوره مطلوب',
		 'mimes' => 'الحقل يجب ان يكون صوره'
]);
     $offer = new Offer;
       if($request->hasFile('image'))
        {
            $image = $request->image;
            $image->move('uploads' , time().$image->getClientOriginalName());
            $offer->image = time().$request->image->getClientOriginalName();
        }
   if(auth()->user() && auth()->user()->isAdmin == 'admin'){}
   elseif(Auth::user() &&Auth::user()->is_student == 5){
     $offer->center_id = auth()->id();
   }
        $offer->save();
        return redirect()->route('offers');
 } public function editoffer($id){
	 $offer = Offer::where('id',$id)->first();
     return view('dashboard.editoffer')->with('offer',$offer);
 }
 public function updateoffer($id,Request $request){
	  $request->validate([
		 'image' => 'mimes:jpeg,jpg,png,gif',
	 ],[
		 'mimes' => 'الحقل يجب ان يكون صوره'
]);
     $offer = Offer::where('id',$id)->first();
       if($request->hasFile('image'))
        {
		   if(public_path() .'/uploads/'.$offer->image){
		   $link = public_path() .'/uploads/'.$offer->image;
    File::delete($link);
			   }
            $image = $request->image;
            $image->move('uploads' ,$image->getClientOriginalName() );
            $offer->image =$request->image->getClientOriginalName();
        }
        $offer->save();
        return redirect()->route('offers');
 }

 public function deleteoffer($id){
     $offer = Offer::find($id);
	     if(public_path() .'/uploads/'.$offer->image){
		   $link = public_path() .'/uploads/'.$offer->image;
    File::delete($link);
			   }
     $offer->delete();
     return response()->json(['status' => true]);
 }
}