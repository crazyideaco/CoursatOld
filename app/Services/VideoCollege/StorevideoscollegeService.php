<?php


namespace App\Services\VideoCollege;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Lesson;
use Validator;
use App\VideosCollege;
use App\Notification;
use App\Paqa_User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



class StorevideoscollegeService {
    public function storevideoscollege($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            //  'description_ar' => 'required',
            //  'description_en' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            //    'board' => 'required',
            //      'image' => 'required|mimes:jpeg,jpg,png,gif',
            //'pdf' => 'required',
            'url' => 'required'
            //  |mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi'
        ], [
            'required' => 'هذا الحقل مطلوب',
            'mimetypes' => 'هذا الحقل يقبل فيديو فقط',
            'mimes' =>  'هذا الحقل يقبل صوره فق'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        if ($validator->passes()) {
            $lesson = Lesson::where('id', $id)->first();
            $youtube_link = $request->youtube_link ?? null;
            $is_youtube = $request->youtube_link ? 1 : 0;
            $video = new VideosCollege;
            $video->order_number = $request->order_number;
            $video->video_type_link = 7;
            $video->youtube_link = $youtube_link;
            $video->is_youtube = $is_youtube;
            if (auth()->user() && auth()->user()->isAdmin == 'admin') {
                $video->user_id = $lesson->doctor_id;
                $video->name_ar = $request->name_ar;
                $video->name_en = $request->name_en;
                $video->college_id = $lesson->college_id;
                $video->university_id = $lesson->university_id;
                //  }elseif(Auth::user() &&Auth::user()->is_student == 3){
                //         $video->user_id = auth()->user()->id;
                //   $video->college_id = auth()->user()->college_id;
                //  }
                $paqauser = Paqa_User::with("paqa")->where("user_id", $lesson->doctor_id)->first();
                if ($paqauser == null) {
                    $msg =   'انت غير مشر في باقه برجاء لاتراك في باقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } elseif ($paqauser->expired_at == Carbon::now()->format('Y-m-d')) {
                    $msg =  'انهت صلاحيه الباقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } else {

                    $videoall = VideosCollege::where('user_id', $lesson->doctor_id)->where('center_id', null)->where('created_at', '>=', $paqauser->created_at)->pluck('video_size')->toArray();
                    if ($videoall > 0) {
                        $sizepaqa = $paqauser->paqa->size;
                        $sum = array_sum($videoall);
                        $gigasum = $sum / 1024 / 1024;
                        if ($sizepaqa > $gigasum) {

                            $video->division_id = $lesson->division_id;
                            $video->section_id = $lesson->section_id;
                            $video->subjectscollege_id = $lesson->subjectscollege_id;
                            $video->typescollege_id = $lesson->typescollege_id;
                            $video->lesson_id = $lesson->id;
                            $video->description_en = $request->description_en;
                            $video->description_ar = $request->description_ar;
                            if ($request->hasFile('url')) {
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($request->file('url'));

                                $duration =  $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $url = $request->url;
                                $video->video_size = $request->file('url')->getSize() / 1024;

                                // $video->url = $this->upload_video($url);
                                $time = time();
                                \Storage::disk('disk7')->putFileAs("", $request->file("url"), time() . '.' . $url->getClientOriginalExtension());
                                $video->url = $time . '.' . $url->getClientOriginalExtension();
                                //dd($path);
                                $video->storage_type = 1;
                                $video->video_type_link = 7;
                                // dd(\Storage::disk("google")->url($this->upload_video($url)),$this->upload_video($url));
                            }
                            if ($request->hasFile('image')) {
                                $image = $request->image;
                                $image->move('uploads', time() . $image->getClientOriginalName());
                                $video->image = time() . $request->image->getClientOriginalName();
                            }
                            if ($request->hasFile('pdf')) {
                                $pdf = $request->pdf;
                                $pdf->move('uploads', time() . '.' . $pdf->getClientOriginalExtension());
                                $video->pdf = time() . '.' . $pdf->getClientOriginalExtension();
                            }
                            if ($request->hasFile('board')) {
                                $board = $request->board;
                                $board->move('uploads', time() . $board->getClientOriginalName());
                                $video->board = time() . $request->board->getClientOriginalName();
                            }
                            if ($request->pay) {
                                $video->paid =  $request->pay;
                            } else {
                                $video->paid =  0;
                            }

                            $video->save();
                            $students = $lesson->typescollege->studentscollege;
                            foreach ($students as $user) {
                                $not = new Notification;
                                $text = 'لديك فيدو جديد فى كورس ' . $lesson->typescollege->name_ar;
                                $not->title = 'اشعار جيد';
                                $not->text = $text;
                                $not->user_id = $user->id;
                                $not->save();
                                $to = $user->device_token;
                                $data = [
                                    "to" => $to,
                                    'notification' => [
                                        'title' => $not->title,
                                        'body' => $not->text
                                    ],
                                    "data" => [
                                        'title' => $not->title,
                                        'body' => $not->text,
                                        "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                                        'type' => 'general'
                                    ],
                                ];
                                $dataString = json_encode($data);
                                $headers = [
                                    'Authorization: key=AAAANEwk9ss:APA91bEuBLaq1kPuYH94OKvkO4EU_-VMrtmnj63KDB-yioNibhvl7bKbJBEQy6IvnuLyMT6AhoBi83vYe5Ds4-UaEzIyZrL9WO7ObUfTk8dIXFMih3upFFjLvPECl2ApuHe_LL2TKu6g',
                                    'Content-Type: application/json',
                                ];
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                                curl_setopt($ch, CURLOPT_POST, true);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                                $result = curl_exec($ch);
                            }
                            return response()->json(['success' => 'video uploaded']);
                        } else {

                            $msg = 'لقد اسهكت 100% ';
                            return response()->json(['status' => false, 'errors' => $msg]);
                        }
                    }
                }
            } elseif (Auth::user() && Auth::user()->is_student == 3) {
                $video->user_id = auth()->user()->id;
                $video->college_id = $lesson->college_id;
                $video->name_ar = $request->name_ar;
                $video->name_en = $request->name_en;
                $paqauser = Paqa_User::with("paqa")->where("user_id", auth()->user()->id)->first();
                if ($paqauser == null) {
                    $msg =   'انت ر مشترك في باقه باء الاشتراك في باقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } elseif ($paqauser->expired_at == Carbon::now()->format('Y-m-d')) {
                    $msg =  'انتهت صلاحيه الباقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } else {
                    $videoall = VideosCollege::where('user_id', auth()->user()->id)->where('center_id', null)->where('created_at', '>=', $paqauser->created_at)->pluck('video_size')->toArray();
                    if ($videoall > 0) {

                        $sizepaqa = $paqauser->paqa->size;
                        $sum = array_sum($videoall);

                        $gigasum = $sum / 1024 / 1024;
                        if ($sizepaqa > $gigasum) {

                            $video->division_id = $lesson->division_id;
                            $video->section_id = $lesson->section_id;
                            $video->subjectscollege_id = $lesson->subjectscollege_id;
                            $video->typescollege_id = $lesson->typescollege_id;
                            $video->lesson_id = $lesson->id;
                            $video->description_en = $request->description_en;
                            $video->description_ar = $request->description_ar;
                            if ($request->hasFile('url')) {
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($request->file('url'));

                                $duration =  $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $url = $request->url;
                                $video->video_size = $request->file('url')->getSize() / 1024;
                                $time = time();
                                \Storage::disk('disk7')->putFileAs("", $request->file("url"), time() . '.' . $url->getClientOriginalExtension());
                                $video->url = $time . '.' . $url->getClientOriginalExtension();
                                $video->storage_type = 1;
                            }
                            if ($request->hasFile('image')) {
                                $image = $request->image;
                                $image->move('uploads', time() . $image->getClientOriginalName());
                                $video->image = time() . $request->image->getClientOriginalName();
                            }
                            if ($request->hasFile('pdf')) {
                                $pdf = $request->pdf;
                                $pdf->move('uploads', time() . '.' . $pdf->getClientOriginalExtension());
                                $video->pdf = time() . '.' . $pdf->getClientOriginalExtension();
                            }
                            if ($request->hasFile('board')) {
                                $board = $request->board;
                                $board->move('uploads', time() . $board->getClientOriginalName());
                                $video->board = time() . $request->board->getClientOriginalName();
                            }
                            if ($request->pay) {
                                $video->paid =  $request->pay;
                            } else {
                                $video->paid =  0;
                            }

                            $video->save();
                            $students = $lesson->typescollege->studentscollege;
                            foreach ($students as $user) {
                                $not = new Notification;
                                $text = 'لديك فيديو جديد فى كورس ' . $lesson->typescollege->name_ar;
                                $not->title = 'اشعار جديد';
                                $not->text = $text;
                                $not->user_id = $user->id;
                                $not->save();
                                $to = $user->device_token;
                                $data = [
                                    "to" => $to,
                                    'notification' => [
                                        'title' => $not->title,
                                        'body' => $not->text
                                    ],
                                    "data" => [
                                        'title' => $not->title,
                                        'body' => $not->text,
                                        "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                                        'type' => 'general'
                                    ],
                                ];
                                $dataString = json_encode($data);
                                $headers = [
                                    'Authorization: key=AAAANEwk9ss:APA91bEuBLaq1kPuYH94OKvkO4EU_-VMrtmnj63KDB-yioNibhvl7bKbJBEQy6IvnuLyMT6AhoBi83vYe5Ds4-UaEzIyZrL9WO7ObUfTk8dIXFMih3upFFjLvPECl2ApuHe_LL2TKu6g',
                                    'Content-Type: application/json',
                                ];
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                                curl_setopt($ch, CURLOPT_POST, true);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                                $result = curl_exec($ch);
                            }
                            return response()->json(['success' => 'video uploaded']);
                        } else {


                            $msg = 'لقد استهلكت 100% ';
                            return response()->json(['status' => false, 'message' => $msg]);
                        }
                    }
                }
            } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2) {
                $video->center_id = auth()->user()->id;
                $video->user_id = $lesson->doctor_id;
                $video->college_id = $lesson->college_id;
                $video->name_ar = $request->name_ar;
                $video->name_en = $request->name_en;
                $paqauser = Paqa_User::with("paqa")->where("user_id", auth()->user()->id)->first();
                if ($paqauser == null) {
                    $msg =   'انت غير مشترك في باقه برجاء الاشتراك في باه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } elseif ($paqauser->expired_at == Carbon::now()->format('Y-m-d')) {
                    $msg =  'اتهت لاحيه الباقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } else {
                    $videoall = VideosCollege::where('center_id', auth()->user()->id)->where('created_at', '>=', $paqauser->created_at)->pluck('video_size')->toArray();
                    if ($videoall > 0) {
                        $sizepaqa = $paqauser->paqa->size;
                        $sum = array_sum($videoall);
                        $gigasum = $sum / 1024 / 1024;
                        if ($sizepaqa > $gigasum) {

                            $video->division_id = $lesson->division_id;
                            $video->section_id = $lesson->section_id;
                            $video->subjectscollege_id = $lesson->subjectscollege_id;
                            $video->typescollege_id = $lesson->typescollege_id;
                            $video->lesson_id = $lesson->id;
                            $video->description_en = $request->description_en;
                            $video->description_ar = $request->description_ar;
                            if ($request->hasFile('url')) {
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($request->file('url'));

                                $duration =  $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $url = $request->url;
                                $video->video_size = $request->file('url')->getSize() / 1024;
                                $time = time();
                                \Storage::disk('disk7')->putFileAs("", $request->file("url"), time() . '.' . $url->getClientOriginalExtension());
                                $video->url = $time . '.' . $url->getClientOriginalExtension();
                                $video->storage_type = 1;
                            }
                            if ($request->hasFile('image')) {
                                $image = $request->image;
                                $image->move('uploads', time() . $image->getClientOriginalName());
                                $video->image = time() . $request->image->getClientOriginalName();
                            }
                            if ($request->hasFile('pdf')) {
                                $pdf = $request->pdf;
                                $pdf->move('uploads', time() . '.' . $pdf->getClientOriginalExtension());
                                $video->pdf = time() . '.' . $pdf->getClientOriginalExtension();
                            }
                            if ($request->hasFile('board')) {
                                $board = $request->board;
                                $board->move('uploads', time() . $board->getClientOriginalName());
                                $video->board = time() . $request->board->getClientOriginalName();
                            }
                            if ($request->pay) {
                                $video->paid =  $request->pay;
                            } else {
                                $video->paid =  0;
                            }

                            $video->save();
                            $students = $lesson->typescollege->studentscollege;
                            foreach ($students as $user) {
                                $not = new Notification;
                                $text = 'لديك فيديو جيد فى كورس ' . $lesson->typescollege->name_ar;
                                $not->title = 'اشعار جديد';
                                $not->text = $text;
                                $not->user_id = $user->id;
                                $not->save();
                                $to = $user->device_token;
                                $data = [
                                    "to" => $to,
                                    'notification' => [
                                        'title' => $not->title,
                                        'body' => $not->text
                                    ],
                                    "data" => [
                                        'title' => $not->title,
                                        'body' => $not->text,
                                        "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                                        'type' => 'general'
                                    ],
                                ];
                                $dataString = json_encode($data);
                                $headers = [
                                    'Authorization: key=AAAANEwk9ss:APA91bEuBLaq1kPuYH94OKvkO4EU_-VMrtmnj63KDB-yioNibhvl7bKbJBEQy6IvnuLyMT6AhoBi83vYe5Ds4-UaEzIyZrL9WO7ObUfTk8dIXFMih3upFFjLvPECl2ApuHe_LL2TKu6g',
                                    'Content-Type: application/json',
                                ];
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                                curl_setopt($ch, CURLOPT_POST, true);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                                $result = curl_exec($ch);
                            }
                            return response()->json(['success' => 'video uploaded']);
                        } else {

                            $msg = 'لق استهلكت 100% ';
                            return response()->json(['status' => false, 'errors' => $msg]);
                        }
                    }
                }
            }
        } else {
            $msg = $validator->messages()->first();
            return response()->json(['status' => false, 'errors' => $msg]);
        }
    }
}// End of service
