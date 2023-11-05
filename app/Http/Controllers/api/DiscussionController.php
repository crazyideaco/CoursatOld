<?php

namespace App\Http\Controllers\api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\General;
use Illuminate\Support\Collection;
use App\User;
use App\Sub;
use App\User_Owner;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Type;
use App\Course;
use App\Stage;
use App\University;
use App\College;
use App\Section;
use App\Division;
use App\TypesCollege;
use App\Student_Type;
use App\Student_Typecollege;
use App\Student_Course;
use App\Subtype;
use App\Student_Subtype;
use App\Student_Lesson;
use App\Lesson;
use App\Course_Rate;
use App\Typecollege_Rate;
use App\Type_Rate;
use App\Subject;
use App\SubjectsCollege;
use App\Message;
use App\VideosGeneral;
use App\Notification;
use Carbon\Carbon;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\ExamResource;
use App\Http\Resources\DiscussionResource;
use App\Http\Resources\ReplyResource;
use App\TypescollegeExam;
use App\TypeExam;
use App\Year;
use App\BasicDiscussion;
use App\CollegediscussionReply;
use App\CollegediscussionTag;
use App\CollegeDiscussion;
use App\BasicdiscussionReply;
use App\BasicdiscussionTag;
use App\GroupType;
use App\GroupTypescollege;
use App\Http\Resources\GroupResource;
class DiscussionController extends Controller
{
  public function add_discussion(Request $request){
    $user = auth()->user();
    if(auth()->user()->category_id == 1){
      $year = Year::where('id',$user->year_id)->first();
    $discussion = new BasicDiscussion;
      $discussion->title = $request->title;
      $discussion->user_id = auth()->id();
      if($year){
        $discussion->years_id = $year->id;
      }
      if($request->group_id){
        if(GroupType::where('id',$request->group_id)->first()){
            $discussion->group_id = $request->group_id;
        }else{
                 return response()->json([
      'status' => false,
    'message' => 'لا يوجد جروب بهذا الاسم']);
        }
      
      }if($request->hasFile('image'))
        {
            $image = $request->image;
            $image->move('uploads' , time(). '.'.$image->getClientOriginalExtension());
            $discussion->image =time(). '.'.$image->getClientOriginalExtension();
        }
        $discussion->category_id = 1;
      $discussion->save();
      if($request->tag_ids){
        $discussion->tags()->attach($request->tag_ids);
      }
      return response()->json(['status' => true,'message' => 'تم اضافه المناقشه بنجاح',
                              'data' => new DiscussionResource($discussion)]);
      } else if(auth()->user()->category_id == 2){
        $university = University::where('id',$user->university_id)->first();
       $college = College::where('id',$user->college_id)->first();
        $division = Division::where('id',$user->division_id)->first();
        $section = College::where('id',$user->section_id)->first();
        $discussion = new CollegeDiscussion;
      $discussion->title = $request->title;
      $discussion->user_id = auth()->id();
      if($university){
        $discussion->university_id = $university->id;
      } if($college){
        $discussion->college_id = $college->id;
      } if($section){
        $discussion->section_id = $section->id;
      } if($division){
        $discussion->division_id = $division->id;
      }
      if($request->group_id){
         if(GroupTypescollege::where('id',$request->group_id)->first()){
            $discussion->group_id = $request->group_id;
        }else{
                 return response()->json([
      'status' => false,
    'message' => 'لا يوجد جروب بهذا الاسم']);
        }
      
       
      }if($request->hasFile('image'))
        {
            $image = $request->image;
            $image->move('uploads' , time(). '.'.$image->getClientOriginalExtension());
            $discussion->image =time(). '.'.$image->getClientOriginalExtension();
        }
        $discussion->category_id = 2;
      $discussion->save();
      if($request->tag_ids){
        $discussion->tags()->attach($request->tag_ids);
      }
        return response()->json(['status' => true,'message' => 'تم اضافه المناقشه بنجاح',
                              'data' => new DiscussionResource($discussion)]);
      }
  }public function add_discussion_reply(Request $request){
    if(auth()->user()->category_id == 1){
       $discussion =  BasicDiscussion::where('id',$request->discussion_id)->first();
         if(is_null($discussion)){
       return response()->json([
      'status' => false,
    'message' => 'لا يوجد مناقشه بهذا الاسم']);
    }
      $reply = new BasicdiscussionReply;
      $reply->user_id = auth()->id();
      $reply->basicdiscussion_id  = $discussion->id;
      if($request->hasFile('image'))
        {
            $image = $request->image;
            $image->move('uploads' , time(). '.'.$image->getClientOriginalExtension());
            $reply->image =time(). '.'.$image->getClientOriginalExtension();
        }
      $reply->reply = $request->reply;
      $reply->save();
        return response()->json(['status' => true,'message' => 'تم اضافه الرد بنجاح',
                                'data' => new ReplyResource($reply)]);
    }else if(auth()->user()->category_id == 2){
        $discussion =  CollegeDiscussion::where('id',$request->discussion_id)->first();
            if(is_null($discussion)){
       return response()->json([
      'status' => false,
    'message' => 'لا يوجد مناقشه بهذا الاسم']);
    }
      $reply = new CollegediscussionReply;
         $reply->user_id = auth()->id();
      $reply->collegediscussion_id  = $discussion->id;
      if($request->hasFile('image'))
        {
            $image = $request->image;
            $image->move('uploads' , time(). '.'.$image->getClientOriginalExtension());
            $reply->image =time(). '.'.$image->getClientOriginalExtension();
        }
      $reply->reply = $request->reply;
      $reply->save();
        return response()->json(['status' => true,'message' => 'تم اضافه الرد بنجاح',
                                'data' => new ReplyResource($reply)]);
    }
  }public function fetch_discussions(){
    $user = auth()->user();
     if(auth()->user()->category_id == 1){
       $discussions =  BasicDiscussion::where('years_id',$user->year_id)->orderBy("id","desc")->get();
       return response()->json(['status' => true,'message' => 'كل المناقشات',
                       'data' =>  DiscussionResource::collection($discussions)]); 
     }
     else if(auth()->user()->category_id == 2){
       $discussions =  CollegeDiscussion::where('section_id',$user->section_id)->orderBy("id","desc")->get();
        return response()->json(['status' => true,'message' => 'كل المناقشات',
                  'data' =>  DiscussionResource::collection($discussions)]);
     }
  }public function fetch_groups_discussions(Request $request){
        $user = auth()->user();
     if(auth()->user()->category_id == 1){
       $discussions =  BasicDiscussion::where('group_id',$request->group_id)->orderBy("id","desc")->get();
       return response()->json(['status' => true,'message' => 'كل المناقشات',
                       'data' =>  DiscussionResource::collection($discussions)]); 
     }
     else if(auth()->user()->category_id == 2){
       $discussions =  CollegeDiscussion::where('group_id',$request->group_id)->orderBy("id","desc")->get();
        return response()->json(['status' => true,'message' => 'كل المناقشات',
                  'data' =>  DiscussionResource::collection($discussions)]);
     }
  }public function discussion_replies(Request $request){
      $user = auth()->user();
     if(auth()->user()->category_id == 1){
       $discussion =  BasicDiscussion::where('id',$request->discussion_id)->first();
        if($discussion){
       return response()->json(['status' => true,'message' => 'كل الرودود',
                       'data' =>  ReplyResource::collection($discussion->replies)]); 
        }else{
         return response()->json(['status' => true,'message' => 'لا يوجد مناقشه بهذا الاسم']);
       }
     }
     else if(auth()->user()->category_id == 2){
       $discussion =  CollegeDiscussion::where('id',$request->discussion_id)->first();
       if($discussion){
       return response()->json(['status' => true,'message' => 'كل الرودود',
                       'data' =>  ReplyResource::collection($discussion->replies)]); 
       }else{
         return response()->json(['status' => true,'message' => 'لا يوجد مناقشه بهذا الاسم']);
       }
     }
  }public function fetch_my_groups(){
        $user = auth()->user();
     if(auth()->user()->category_id == 1){
      $groups = $user->groupstype;
       return response()->json(['status' => true,'message' => 'مجموعاتك',
                       'data' =>  GroupResource::collection($groups)]); 
     }
     else if(auth()->user()->category_id == 2){
      $groups = $user->groupstypescollege;
         return response()->json(['status' => true,'message' => 'مجموعاتك',
                       'data' =>  GroupResource::collection($groups)]);
     }
  }public function delete_discussion(Request $request){
      $user = auth()->user();
     if(auth()->user()->category_id == 1){
       $discussion =  BasicDiscussion::where('id',$request->discussion_id)->first();
        if($discussion){
          $discussion->delete();
       return response()->json(['status' => true,'message' => 'تم المسح بنجاح',
                     ]); 
        }else{
         return response()->json(['status' => true,'message' => 'لا يوجد مناقشه بهذا الاسم']);
       }
     }
     else if(auth()->user()->category_id == 2){
       $discussion =  CollegeDiscussion::where('id',$request->discussion_id)->first();
       if($discussion){
          $discussion->delete();
       return response()->json(['status' => true,'message' => 'تم المسح بنجاح',
                     ]); 
       }else{
         return response()->json(['status' => true,'message' => 'لا يوجد مناقشه بهذا الاسم']);
       }
     }
  }
}