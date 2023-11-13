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
class CategoryController extends Controller
{
       public function editcategory($id){
         return view('dashboard.editcategory')->with('category',Category::where('id',$id)->first());
     }   
     public function storecategory($id,Request $request){
         $category = Category::where('id',$id)->first();
         $category->name = $request->name;
              if($request->hasFile('image'))
        {
				  if(public_path().'/category/'.$category->image){
				  $link = public_path().'/category/'.$category->image;
					File::delete($link);
				  }
            $image = $request->image;
            $image->move('category' , time(). '.'.$image->getClientOriginalExtension());
           $category->image = time(). '.'.$image->getClientOriginalExtension();
        }
        $category->save();
        return redirect()->route('categoryall');
     }
     public function category(){
         return view('dashboard.category')->with('category',Category::orderBy('created_at','asc')->take(3)->get());
     }
}