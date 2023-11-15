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
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Video;

class UpdatevideoService
{

    use GeneralTrait;

    public function updatevideo($id, Request $request)
    {

        $subtype = Subtype::where('id', $id)->first();
        $validator = Validator::make($request->all(), [
            // 'description_ar' => 'required',
            //    'description_en' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            //     'image' => 'mimes:jpeg,jpg,png,gif',
            //  'url' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi'
        ], [
            'required' => 'هذا الحقل مطوب',
            'mimetypes' => 'هذا الحقل يقبل فديو فقط',
            'mimes' =>  'هذا الحقل يقب صوره فقط'
        ]);

        if ($validator->passes()) {

            $video = Video::where('id', $id)->first();

            $youtube_link = $request->youtube_link ?? $video->youtube_link;
            $is_youtube = $request->youtube_link ? 1 : $video->is_youtube;

            $video->order_number = $request->order_number;

            $video->youtube_link = $youtube_link;
            $video->is_youtube = $is_youtube;

            if (auth()->user() && auth()->user()->isAdmin == 'admin') {
                $video->name_ar = $request->name_ar;
                $video->name_en = $request->name_en;
                $paqauser = Paqa_User::with("paqa")->where("user_id", $video->user_id)->first();
                if ($paqauser == null) {

                    $msg = 'انت غير مترك في باقه برجاء الاشتراك في باقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } elseif ($paqauser->expired_at == Carbon::now()->format('Y-m-d')) {


                    $msg =  'انتهت صلاحه الباقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } else {
                    $videoall = Video::where('user_id', $video->user_id)->where('center_id', null)->where('created_at', '>=', $paqauser->created_at)->pluck('size_video')->toArray();
                    if ($videoall > 0) {
                        $sizepaqa = $paqauser->paqa->size;
                        $sum = array_sum($videoall);
                        $gigasum = $sum / 1024 / 1024;
                        if ($sizepaqa > $gigasum) {
                            $video->description_ar = $request->description_ar;
                            if ($request->hasFile('url')) {
                                if (public_path() . '/uploads/' . $video->url) {
                                    $link = public_path() . '/uploads/' . $video->url;
                                    File::delete($link);
                                }
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($request->file('url'));

                                $duration =  $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $url = $request->url;
                                $video->size_video = $request->file('url')->getSize() / 1024;
                                $url->move('uploads', time() . '.' . $url->getClientOriginalExtension());
                                $video->url = time() . '.' . $url->getClientOriginalExtension();
                                $video->video_type_link = 6;
                            }
                            if ($request->hasFile('image')) {
                                if (public_path() . '/uploads/' . $video->image) {
                                    $link = public_path() . '/uploads/' . $video->image;
                                    File::delete($link);
                                }
                                $image = $request->image;
                                $image->move('uploads', time() . $image->getClientOriginalName());
                                $video->image = time() . $request->image->getClientOriginalName();
                            }
                            if ($request->hasFile('pdf')) {
                                if (public_path() . '/uploads/' . $video->pdf) {
                                    $link = public_path() . '/uploads/' . $video->pdf;
                                    File::delete($link);
                                }
                                $pdf = $request->pdf;
                                $pdf->move('uploads', time() . $pdf->getClientOriginalName());
                                $video->pdf = time() . $request->pdf->getClientOriginalName();
                            }
                            if ($request->hasFile('board')) {
                                if (public_path() . '/uploads/' . $video->board) {
                                    $link = public_path() . '/uploads/' . $video->board;
                                    File::delete($link);
                                }
                                $board = $request->board;
                                $board->move('uploads', time() . $board->getClientOriginalName());
                                $video->board = time() . $request->board->getClientOriginalName();
                            }
                            if ($request->pay) {
                                $video->paid =  $request->pay;
                            }

                            $video->save();
                            return response()->json(['status' => true, 'success' => 'video uploaded']);
                        } else {

                            $msg = 'لقد اتهلكت 100% ';
                            return response()->json(['status' => 'false', 'errors' => $msg]);
                        }
                    }
                }
            } elseif (Auth::user() && Auth::user()->is_student == 2) {

                $video->user_id = auth()->user()->id;
                $video->name_ar = $request->name_ar;
                $video->name_en = $request->name_en;
                $paqauser = Paqa_User::with("paqa")->where("user_id", auth()->user()->id)->first();
                if ($paqauser == null) {
                    $msg = 'انت غير مشترك في باقه برجاء الاشتراك في باقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } elseif ($paqauser->expired_at == Carbon::now()->format('Y-m-d')) {
                    $msg =  'انتهت صلاحيه الباقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } else {
                    $videoall = Video::where('user_id', auth()->user()->id)->where('center_id', null)->where('created_at', '>=', $paqauser->created_at)->pluck('size_video')->toArray();
                    if ($videoall > 0) {
                        $sizepaqa = $paqauser->paqa->size;
                        $sum = array_sum($videoall);
                        $gigasum = $sum / 1024 / 1024;
                        if ($sizepaqa > $gigasum) {
                            $video->description_ar = $request->description_ar;
                            $video->description_en = $request->description_en;
                            if ($request->hasFile('url')) {
                                if (public_path() . '/uploads/' . $video->url) {
                                    $link = public_path() . '/uploads/' . $video->url;
                                    File::delete($link);
                                }
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($request->file('url'));

                                $duration =  $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $url = $request->url;
                                $video->size_video = $request->file('url')->getSize() / 1024;
                                \Storage::disk('disk6/disk6')->putFileAs("", $request->file("url"), time() . '.' . $url->getClientOriginalExtension());
                                $video->url = time() . '.' . $url->getClientOriginalExtension();

                                $video->video_type_link = 6;
                            }
                            if ($request->hasFile('image')) {
                                if (public_path() . '/uploads/' . $video->image) {
                                    $link = public_path() . '/uploads/' . $video->image;
                                    File::delete($link);
                                }
                                $image = $request->image;
                                $image->move('uploads', time() . $image->getClientOriginalName());
                                $video->image = time() . $request->image->getClientOriginalName();
                            }
                            if ($request->hasFile('pdf')) {
                                if (public_path() . '/uploads/' . $video->pdf) {
                                    $link = public_path() . '/uploads/' . $video->pdf;
                                    File::delete($link);
                                }
                                $pdf = $request->pdf;
                                $pdf->move('uploads', time() . $pdf->getClientOriginalName());
                                $video->pdf = time() . $request->pdf->getClientOriginalName();
                            }
                            if ($request->hasFile('board')) {
                                if (public_path() . '/uploads/' . $video->board) {
                                    $link = public_path() . '/uploads/' . $video->board;
                                    File::delete($link);
                                }
                                $board = $request->board;
                                $board->move('uploads', time() . $board->getClientOriginalName());
                                $video->board = time() . $request->board->getClientOriginalName();
                            }
                            if ($request->pay) {
                                $video->paid =  $request->pay;
                            }

                            $video->save();
                            return response()->json(['status' => true, 'success' => 'video uploaded']);
                        } else {

                            $msg = 'لقد اسهلكت 100% ';
                            return response()->json(['status' => false, 'errors' => $msg]);
                        }
                    }
                }
            } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1) {

                $video->center_id = auth()->user()->id;
                $video->name_ar = $request->name_ar;
                $video->name_en = $request->name_en;
                $paqauser = Paqa_User::with("paqa")->where("user_id", auth()->user()->id)->first();
                if ($paqauser == null) {
                    $msg = 'انت غير مشترك في باقه برجاء الاشتراك في باه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } elseif ($paqauser->expired_at == Carbon::now()->format('Y-m-d')) {
                    $msg =  'انتهت صلاحيه الباقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } else {
                    $videoall = Video::where('center_id', auth()->user()->id)->where('created_at', '>=', $paqauser->created_at)->pluck('size_video')->toArray();
                    if ($videoall > 0) {
                        $sizepaqa = $paqauser->paqa->size;
                        $sum = array_sum($videoall);
                        $gigasum = $sum / 1024 / 1024;
                        if ($sizepaqa > $gigasum) {
                            $video->description_ar = $request->description_ar;
                            $video->description_en = $request->description_en;

                            if ($request->hasFile('url')) {
                                if (public_path() . '/uploads/' . $video->url) {
                                    $link = public_path() . '/uploads/' . $video->url;
                                    File::delete($link);
                                }
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($request->file('url'));

                                $duration =  $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $url = $request->url;
                                $video->size_video = $request->file('url')->getSize() / 1024;
                                \Storage::disk('disk6/disk6')->putFileAs("", $request->file("url"), time() . '.' . $url->getClientOriginalExtension());
                                $video->url = time() . '.' . $url->getClientOriginalExtension();
                                $video->video_type_link = 6;
                            }
                            //image

                            if ($request->hasFile('image')) {
                                if (public_path() . '/uploads/' . $video->image) {
                                    $link = public_path() . '/uploads/' . $video->image;
                                    File::delete($link);
                                }
                                $image = $request->image;
                                $image->move('uploads', time() . $image->getClientOriginalName());
                                $video->image = time() . $request->image->getClientOriginalName();
                            }
                            if ($request->hasFile('pdf')) {
                                if (public_path() . '/uploads/' . $video->pdf) {
                                    $link = public_path() . '/uploads/' . $video->pdf;
                                    File::delete($link);
                                }
                                $pdf = $request->pdf;
                                $pdf->move('uploads', time() . $pdf->getClientOriginalName());
                                $video->pdf = time() . $request->pdf->getClientOriginalName();
                            }
                            if ($request->hasFile('board')) {
                                if (public_path() . '/uploads/' . $video->board) {
                                    $link = public_path() . '/uploads/' . $video->board;
                                    File::delete($link);
                                }
                                $board = $request->board;
                                $board->move('uploads', time() . $board->getClientOriginalName());
                                $video->board = time() . $request->board->getClientOriginalName();
                            }
                            if ($request->pay) {
                                $video->paid =  $request->pay;
                            }

                            $video->save();
                            return response()->json(['status' => true, 'success' => 'video uploaded']);
                        } else {


                            $msg = 'لقد استهكت 100% ';
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
}//End of service
