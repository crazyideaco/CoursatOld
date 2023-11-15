<?php


namespace App\Services\VideoCollege;


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


class UpdateVideoscollegeService {

    use GeneralTrait;

    public function updatevideoscollege($id, Request $request)
    {


        $subtype = Subtype::where('id', $id)->first();
        $validator = Validator::make($request->all(), [
            // 'description_ar' => 'required',
            //   'description_en' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            //     'image' => 'mimes:jpeg,jpg,png,gif',
            //     'url' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi'
        ], [
            'required' => 'هذا الحقل مطلوب',
            'mimetypes' => 'هذا الحقل يقبل يديو فقط',
            'mimes' =>  'هذا الحقل يقبل صوره فق'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        if ($validator->passes()) {
            $video = VideosCollege::where('id', $id)->first();

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
                    $msg = 'انت غي مشترك في باقه براء الاتراك في باقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } elseif ($paqauser->expired_at == Carbon::now()->format('Y-m-d')) {
                    $msg =  'انتهت صلاحيه الباقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } else {

                    $videoall = VideosCollege::where('user_id', $video->user_id)->where('center_id', null)->where('created_at', '>=', $paqauser->created_at)->pluck('video_size')->toArray();
                    if ($videoall > 0) {
                        $sizepaqa = $paqauser->paqa->size;
                        $sum = array_sum($videoall);
                        $gigasum = $sum / 1024 / 1024;
                        if ($sizepaqa > $gigasum) {
                            $video->description_en = $request->description_en;
                            $video->description_ar = $request->description_ar;
                            if ($request->hasFile('url')) {
                                $this->delete_video($video);
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($request->file('url'));

                                $duration =  $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $video->video_size = $request->file('url')->getSize() / 1024;

                                $url = $request->url;
                                $time = time();
                                \Storage::disk('disk6/disk6')->putFileAs("", $request->file("url"), time() . '.' . $url->getClientOriginalExtension());
                                $video->url = $time . '.' . $url->getClientOriginalExtension();
                                $video->storage_type = 1;
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
                                };
                                $pdf = $request->pdf;
                                $pdf->move('uploads', time() . '.' . $pdf->getClientOriginalExtension());
                                $video->pdf = time() . '.' . $pdf->getClientOriginalExtension();
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
                            } else {
                                $video->paid = 0;
                            }

                            $video->save();

                            return response()->json(['success' => 'video uploaded']);
                        } else {

                            $msg = 'لقد استهلكت 100% ';
                            return response()->json(['status' => false, 'errors' => $msg]);
                        }
                    }
                }
            } elseif (Auth::user() && Auth::user()->is_student == 3) {
                $video->user_id = auth()->user()->id;

                $video->name_ar = $request->name_ar;
                $video->name_en = $request->name_en;
                $paqauser = Paqa_User::with("paqa")->where("user_id", auth()->user()->id)->first();
                if ($paqauser == null) {
                    $msg = 'انت غير مشترك في باقه برجء الاشتراك في اقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } elseif ($paqauser->expired_at == Carbon::now()->format('Y-m-d')) {
                    $msg =  'انتهت صلاحيه اباقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } else {
                    $videoall = VideosCollege::where('user_id', auth()->user()->id)->where('center_id', null)->where('created_at', '>=', $paqauser->created_at)->pluck('video_size')->toArray();
                    if ($videoall > 0) {

                        $sizepaqa = $paqauser->paqa->size;
                        $sum = array_sum($videoall);

                        $gigasum = $sum / 1024 / 1024;
                        if ($sizepaqa > $gigasum) {
                            $video->description_en = $request->description_en;
                            $video->description_ar = $request->description_ar;
                            if ($request->hasFile('url')) {
                                $this->delete_video($video);
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($request->file('url'));

                                $duration =  $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $video->video_size = $request->file('url')->getSize() / 1024;

                                $url = $request->url;
                                $time = time();
                                \Storage::disk('disk6/disk6')->putFileAs("", $request->file("url"), time() . '.' . $url->getClientOriginalExtension());
                                $video->url = $time . '.' . $url->getClientOriginalExtension();
                                $video->storage_type = 1;
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
                                };
                                $pdf = $request->pdf;
                                $pdf->move('uploads', time() . '.' . $pdf->getClientOriginalExtension());
                                $video->pdf = time() . '.' . $pdf->getClientOriginalExtension();
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
                            } else {
                                $video->paid = 0;
                            }
                            $video->save();
                            return response()->json(['success' => 'video uploaded']);
                        } else {

                            $msg = 'لق اتهلكت 100% ';
                            return response()->json(['status' => false, 'errors' => $msg]);
                        }
                    }
                }
            } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2) {

                $video->name_ar = $request->name_ar;
                $video->name_en = $request->name_en;
                $paqauser = Paqa_User::with("paqa")->where("user_id", auth()->user()->id)->first();
                if ($paqauser == null) {
                    $msg = 'نت غير مشترك في بقه برجاء الاشترا ي باقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } elseif ($paqauser->expired_at == Carbon::now()->format('Y-m-d')) {
                    $msg =  'انتهت صلاحه لباقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } else {
                    $videoall = VideosCollege::where('center_id', auth()->user()->id)->where('created_at', '>=', $paqauser->created_at)->pluck('video_size')->toArray();
                    if ($videoall > 0) {
                        $sizepaqa = $paqauser->paqa->size;
                        $sum = array_sum($videoall);
                        $gigasum = $sum / 1024 / 1024;
                        if ($sizepaqa > $gigasum) {
                            $video->description_en = $request->description_en;
                            $video->description_ar = $request->description_ar;
                            if ($request->hasFile('url')) {
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($request->file('url'));

                                $duration =  $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $this->delete_video($video);
                                $video->video_size = $request->file('url')->getSize() / 1024;

                                $url = $request->url;
                                $time = time();
                                \Storage::disk('disk6/disk6')->putFileAs("", $request->file("url"), time() . '.' . $url->getClientOriginalExtension());
                                $video->url = $time . '.' . $url->getClientOriginalExtension();
                                $video->storage_type = 1;
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
                                };
                                $pdf = $request->pdf;
                                $pdf->move('uploads', time() . '.' . $pdf->getClientOriginalExtension());
                                $video->pdf = time() . '.' . $pdf->getClientOriginalExtension();
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
                            } else {
                                $video->paid = 0;
                            }
                            $video->save();
                            return response()->json(['success' => 'video uploaded']);
                        } else {
                            $msg = 'لقد استهلت 100% ';
                            return response()->json(['status' => false, 'errors' => $msg]);
                        }
                    }
                }
            }
        } else {
            $msg = $validator->messages()->first();
            return response()->json(['status' => false, 'message' => $msg]);
        }
    }
}
