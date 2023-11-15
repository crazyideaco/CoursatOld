<?php

namespace App\Services\VideoBasic;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Lesson;
use Validator;
use App\VideosCollege;
use App\Notification;
use App\Paqa_User;
use App\Subtype;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Video;
use Illuminate\Validation\Rule;

class StorevideoService
{
    public function storevideo($id,Request $request){

        //dd(\Storage::disk('google')->delete("1XBtzNFUYhgGsibOxILp1FBCiZiLNzjyl"));
        //dd(\Storage::disk('google')->url($name));
        $subtype = Subtype::where('id',$id)->first();

        $validator = Validator::make($request->all(),[
            //'description_ar' => 'required',
            //'description_en' => 'required',
            //    'name_ar' => 'required',
            //  'name_en' => 'required',
            //    'board' => 'required',
            //  'image' => 'required|mimes:jpeg,jpg,png,gif',
            //  'pdf' => 'required',
            'url' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    return $request->youtube_link == null;
                })
            ],

            'youtube_link' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    return $request->url == null;
                })
            ],

        ],[
            'required' => 'هذا الحقل مطلوب' ,
            'mimetypes' => 'هذا الحقل يقب فيديو فقط',
            'mimes' =>  'هذا الحقل يقبل صوره فقط'
        ]);

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        if($validator->passes()){

            $youtube_link = $request->youtube_link ?? null;
            $is_youtube = $request->youtube_link ? 1 : 0;
            $video = new Video;
            $video->order_number = $request->order_number;
            $video->name_ar = $request->name_ar;
            $video->name_en = $request->name_en;

            $video->is_youtube = $is_youtube;
            $video->youtube_link = $youtube_link;

            if(auth()->user() && auth()->user()->isAdmin == 'admin'){
                // $video = new Video;
                // $video->order_number = $request->order_number;
                $video->user_id = $subtype->user_id;
                // $video->name_ar = $request->name_ar;
                // $video->name_en = $request->name_en;
                $paqauser= Paqa_User::with("paqa")->where("user_id",$subtype->user_id)->first();
                if($paqauser==null){
                    $msg='انت غير مشترك في باقه برجاء الاشتراك في بقه';
                    return response()->json(['status' => false,'errors' => $msg]);
                }
                elseif($paqauser->expired_at ==Carbon::now()->format('Y-m-d')){
                    $msg = 'انتهت صلاحيه البقه';
                    return response()->json(['status' => false,'errors' => $msg]);

                }else{
                    $videoall= Video::where('user_id',$subtype->user_id)->where('center_id',null)->
                    where('created_at','>=',$paqauser->created_at)->pluck('size_video')->toArray();
                    if($videoall > 0){
                        $sizepaqa=$paqauser->paqa->size;
                        $sum=array_sum($videoall);
                        $gigasum=$sum/1024/1024;
                        if($sizepaqa >$gigasum ){
                            $video->subject_id = $subtype->subjects_id;
                            $video->year_id = $subtype->years_id;
                            $video->type_id = $subtype->type_id;
                            $video->subtype_id = $subtype->id;
                            $video->description_ar = $request->description_ar;
                            $video->description_en = $request->description_en;

                            if($request->hasFile('url'))
                            {
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($request->file('url'));

                                $duration =  $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $url = $request->url;
                                $video->size_video= $request->file('url')->getSize()/1024;
                                //   \Storage::disk('disk6')->putFileAs("",$request->file("url"),time(). '.'.$url->getClientOriginalExtension());
                                //  $url->storeAs('/', time(). '.'.$url->getClientOriginalExtension(), 'uploads');

                                \Storage::disk('disk6')->putFileAs("",$request->file("url"),time(). '.'.$url->getClientOriginalExtension());
                                //  \Storage::disk('uploads')->putFileAs('', $url,  time(). '.'.$url->getClientOriginalExtension());
                                $video->url = time(). '.'.$url->getClientOriginalExtension();
                                $video->video_type_link = 6;
                            }
                            if($request->hasFile('image'))
                            {
                                $image = $request->image;
                                $image->move('uploads' , time().$image->getClientOriginalName());
                                $video->image = time().$request->image->getClientOriginalName();
                            }
                            if($request->hasFile('pdf'))
                            {
                                $pdf = $request->pdf;
                                $pdf->move('uploads' , time().$pdf->getClientOriginalName());
                                $video->pdf = time().$request->pdf->getClientOriginalName();
                            }
                            if($request->hasFile('board'))
                            {
                                $board = $request->board;
                                $board->move('uploads' ,time(). $board->getClientOriginalName());
                                $video->board = time().$request->board->getClientOriginalName();
                            }
                            if($request->pay){
                                $video->paid=  $request->pay;
                            }

                            $video->save();
                            return response()->json(['success' => 'video uploaded']);

                        }else{

                            $msg =  'لقد استهلكت 100% ';

                            return response()->json(['status' => false,'errors' => $msg]);

                        }
                    }

                }

            }elseif(Auth::user() &&Auth::user()->is_student == 2){
                // $video = new Video;
                // $video->order_number = $request->order_number;
                $video->user_id = auth()->user()->id;
                // $video->name_ar = $request->name_ar;
                // $video->name_en = $request->name_en;
                $paqauser= Paqa_User::with("paqa")->where("user_id",auth()->user()->id)->first();
                if($paqauser==null){
                    $msg='انت غير مشترك في باقه برجاء الاشتراك في بقه';
                    return response()->json(['status' => false,'errors' => $msg]);
                }
                elseif($paqauser->expired_at ==Carbon::now()->format('Y-m-d')){
                    $msg = 'انتهت صلاحيه الباقه';
                    return response()->json(['status' => false,'errors' => $msg]);
                }else{
                    $videoall= Video::where('user_id',auth()->user()->id)->where('center_id',null)->
                    where('created_at','>=',$paqauser->created_at)->pluck('size_video')->toArray();
                    if($videoall > 0){
                        $sizepaqa=$paqauser->paqa->size;
                        $sum=array_sum($videoall);
                        $gigasum=$sum/1024/1024;
                        if($sizepaqa >$gigasum ){
                            $video->subject_id = $subtype->subjects_id;
                            $video->year_id = $subtype->years_id;
                            $video->type_id = $subtype->type_id;
                            $video->subtype_id = $subtype->id;
                            $video->description_ar = $request->description_ar;
                            $video->description_en = $request->description_en;
                            if($request->hasFile('url'))
                            {
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($request->file('url'));

                                $duration =  $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $url = $request->url;
                                $video->size_video= $request->file('url')->getSize()/1024;
                                \Storage::disk('disk6')->putFileAs("",$request->file("url"),time(). '.'.$url->getClientOriginalExtension());
                                $video->url = time(). '.'.$url->getClientOriginalExtension();
                                $video->video_type_link = 6;

                            }
                            if($request->hasFile('image'))
                            {
                                $image = $request->image;
                                $image->move('uploads' , time().$image->getClientOriginalName());
                                $video->image = time().$request->image->getClientOriginalName();
                            }
                            if($request->hasFile('pdf'))
                            {
                                $pdf = $request->pdf;
                                $pdf->move('uploads' , time().$pdf->getClientOriginalName());
                                $video->pdf = time().$request->pdf->getClientOriginalName();
                            }
                            if($request->hasFile('board'))
                            {
                                $board = $request->board;
                                $board->move('uploads' ,time(). $board->getClientOriginalName());
                                $video->board = time().$request->board->getClientOriginalName();
                            }
                            if($request->pay){
                                $video->paid=  $request->pay;
                            }

                            $video->save();
                            return response()->json(['status' => true,'success' => 'video uploaded']);

                        }else{

                            $msg =  'لقد استهلكت 100% ';

                            return response()->json(['status' => false,'errors' => $msg]);

                        }
                    }

                }
            }elseif(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1){
                // $video = new Video;
                // $video->order_number = $request->order_number;
                $video->center_id = auth()->user()->id;
                $video->user_id = $subtype->user_id;
                // $video->name_ar = $request->name_ar;
                // $video->name_en = $request->name_en;
                $paqauser= Paqa_User::with("paqa")->where("user_id",auth()->user()->id )->first();
                if($paqauser==null){
                    $msg='انت غر مشترك في باقه بجاء الاشتراك في باقه';
                    return response()->json(['status' => false,'errors' => $msg]);
                }
                elseif($paqauser->expired_at ==Carbon::now()->format('Y-m-d')){
                    $msg = 'انتهت صلاحيه البقه';
                    return response()->json(['status' => false,'errors' => $msg]);
                }else{
                    $videoall= Video::where('user_id',$request->user_id)->where('center_id',null)->
                    where('created_at','>=',$paqauser->created_at)->pluck('size_video')->toArray();
                    if($videoall > 0){
                        $sizepaqa=$paqauser->paqa->size;
                        $sum=array_sum($videoall);
                        $gigasum=$sum/1024/1024;
                        if($sizepaqa >$gigasum ){
                            $video->subject_id = $subtype->subjects_id;
                            $video->year_id = $subtype->years_id;
                            $video->type_id = $subtype->type_id;
                            $video->subtype_id = $subtype->id;
                            $video->description_ar = $request->description_ar;
                            $video->description_en = $request->description_en;
                            if($request->hasFile('url'))
                            {
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($request->file('url'));

                                $duration =  $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $url = $request->url;
                                $video->size_video= $request->file('url')->getSize()/1024;
                                \Storage::disk('disk6')->putFileAs("",$request->file("url"),time(). '.'.$url->getClientOriginalExtension());
                                $video->url = time(). '.'.$url->getClientOriginalExtension();

                                $video->video_type_link = 6;
                            }
                            if($request->hasFile('image'))
                            {
                                $image = $request->image;
                                $image->move('uploads' , time().$image->getClientOriginalName());
                                $video->image = time().$request->image->getClientOriginalName();
                            }
                            if($request->hasFile('pdf'))
                            {
                                $pdf = $request->pdf;
                                $pdf->move('uploads' , time().$pdf->getClientOriginalName());
                                $video->pdf = time().$request->pdf->getClientOriginalName();
                            }
                            if($request->hasFile('board'))
                            {
                                $board = $request->board;
                                $board->move('uploads' ,time(). $board->getClientOriginalName());
                                $video->board = time().$request->board->getClientOriginalName();
                            }
                            if($request->pay){
                                $video->paid=  $request->pay;
                            }

                            $video->save();
                            return response()->json(['status' => true,'success' => 'video uploaded']);

                        }else{

                            $msg =  'لقد اسهلكت 100% ';

                            return response()->json(['status' => false,'errors' => $msg]);

                        }
                    }

                }
            }
        }else{
            $msg = $validator->messages()->first();
            return response()->json(['status' => false,'errors' => $msg]);
        }
    }
}//End of service
