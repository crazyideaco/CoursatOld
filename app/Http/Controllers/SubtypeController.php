<?php
namespace App\Http\Controllers;

use App\Paqa;
use App\Paqa_User;
use App\Subject;
use App\Subtype;
use App\Tag;
use App\Type;
use App\User;
use App\Video;
use App\Year;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Validator;

class SubtypeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:subtypes-create'])->only('addsubtype');
        $this->middleware(['permission:subtypes-read'])->only('subtypes');
        $this->middleware(['permission:subtypes-update'])->only('editsubtype');
        $this->middleware(['permission:subtypes-delete'])->only('deletesubtype');
    }
    public function deletesubtype($id)
    {
        $subtype = Subtype::where('id', $id)->first();
        if ($subtype->status == 0) {
            if (public_path() . '/uploads/' . $subtype->part_paper) {
                $link = public_path() . '/uploads/' . $subtype->part_paper;
                File::delete($link);}
            if (public_path() . '/uploads/' . $subtype->notes) {
                $link1 = public_path() . '/uploads/' . $subtype->notes;
                File::delete($link1);}
            if (public_path() . '/uploads/' . $subtype->image) {
                $link1 = public_path() . '/uploads/' . $subtype->image;
                File::delete($link1);}if (public_path() . '/uploads/' . $subtype->intro) {
                $link1 = public_path() . '/uploads/' . $subtype->intro;
                File::delete($link1);}
            if ($subtype->videos) {
                foreach ($subtype->videos as $video) {
                    if (public_path() . '/uploads/' . $video->url) {
                        $link = public_path() . '/uploads/' . $video->url;
                        File::delete($link);}
                }
            }

        }
        $subtype->delete();
        return response()->json(['status' => true]);
    }
    public function subtypes($id)
    {

        if (Auth::user() && Auth::user()->isAdmin == 'admin') {
            $type = Type::where('id', $id)->first();
            $subtypes = $type->subtypes;
        } else if (Auth::user() && Auth::user()->is_student == 2) {
            $type = Type::where('id', $id)->first();
            $subtypes = $type->subtypes->where('user_id', Auth::user()->id)->where('center_id', null);
        } else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1) {
            $type = Type::where('id', $id)->first();
            $subtypes = $type->subtypes->where('center_id', Auth::user()->id);
        }
        return view('dashboard.subtypes')->with('subtypes', $subtypes)->with('id', $id);
    }
    public function addsubtype($id)
    {
        if (Auth::user() && Auth::user()->isAdmin == 'admin') {
            $users = User::where('is_student', 2)->get();
            $types = Type::all();
            $subjects = Subject::all();
            $years = Year::all();
        } else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1) {
            $users = auth()->user()->teachers;
            $types = Type::where('center_id', Auth::user()->id)->get();
            $subjects = Subject::all();
            $years = Year::all();
        } else if (Auth::user() && Auth::user()->is_student == 2) {
            $users = "";
            $types = Type::where('user_id', Auth::user()->id)->get();
            $subjects = User::where('id', auth()->user()->id)->first()->subjects;
            $years = auth()->user()->years;
        }
        $tags = Tag::all();
        return view('dashboard.addsubtype')->with('years', $years)
            ->with('subjects', $subjects)
            ->with('types', $types)->with('users', $users)->with('id', $id)->with("tags", $tags);
    }
    public function storesubtype($id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            //   'image' => 'required|mimes:jpeg,jpg,png,gif',
            //   // 'intro' => 'required',
            // 'url' => 'required',
            //    'url.*' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi',
            //    'images' =>'required',
            //'images.*' => 'mimes:jpeg,jpg,png,gif',
            //'boards' => 'required',
            //'boards.*' => 'mimes:jpeg,jpg,png,gif',
            // 'pdf' => 'required'
        ], [
            'required' => 'هذا الحقل مطلوب',
            'mimes' => ' هذا الحقل يقبل صوره فقط',
            'mimetypes' => 'هذا الحقل يقبل فيديو فقط',
        ]

        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        if ($validator->passes()) {

            $type = Type::where('id', $id)->first();

            if (auth()->user() && auth()->user()->isAdmin == 'admin') {
                $paqauser = Paqa_User::with("paqa")->where("user_id", $type->user_id)->first();
                if ($paqauser == null) {
                    $msg = 'انت غير مشترك في باقه برجاء الاشتراك في باقه';
                    return response()->json(['status' => false, 'errors' => $msg]);
                } elseif ($paqauser->expired_at == Carbon::now()->format('Y-m-d')) {
                    $msg = 'انتهت صلاحيه الباقه';
                    return response()->json(['status' => false, 'errors' => $msg]);

                } else {
                    $videoall = Video::where('user_id', $type->user_id)->where('center_id', null)->
                        where('created_at', '>=', $paqauser->created_at)->pluck('size_video')->toArray();
                    if ($videoall > 0) {
                        $sizepaqa = $paqauser->paqa->size;
                        $sum = array_sum($videoall);
                        $gigasum = $sum / 1024 / 1024;
                        if ($sizepaqa > $gigasum) {
                            $subtype = new Subtype;
                            $subtype->order_number = $request->order_number;
                            $subtype->name_ar = $request->name_ar;
                            $subtype->name_en = $request->name_en;
                            $subtype->years_id = $type->years_id;
                            $subtype->subjects_id = $type->subjects_id;
                            $subtype->type_id = $type->id;
                            $subtype->user_id = $type->user_id;
                            $subtype->points = $request->points;
                            $subtype->part_points = $request->part_points;
                            $subtype->description = $request->description;
                            if ($request->hasFile('intro')) {
                                $intro = $request->intro;
                                $intro->move('uploads', time() . '.' . $intro->getClientOriginalExtension());
                                $subtype->intro = time() . '.' . $intro->getClientOriginalExtension();
                            }
                            if ($request->hasFile('image')) {

                                $image = $request->image;

                                $file = $image->getClientOriginalName();
                                $fileName = pathinfo($file, PATHINFO_FILENAME);
                                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                $image->move('uploads', $fileName . '_' . time() . '.' . $fileExtension);
                                $subtype->image = $fileName . '_' . time() . '.' . $fileExtension;

                            }
                            if ($request->hasFile('part_paper')) {
                                $part_paper = $request->part_paper;
                                $part_paper->move('uploads', time() . '.' . $part_paper->getClientOriginalExtension());
                                $subtype->part_paper = time() . '.' . $part_paper->getClientOriginalExtension();
                            }if ($request->hasFile('notes')) {
                                $notes = $request->notes;
                                $notes->move('uploads', time() . '.' . $notes->getClientOriginalExtension());
                                $subtype->notes = time() . '.' . $notes->getClientOriginalExtension();
                            }
                            $subtype->save();
                            if ($request->tag_id) {
                                $subtype->tags()->attach($request->tag_id);

                            }

                            foreach ($request->url as $k => $i) {
                                $video = new Video;
                                $video->order_number = $request->order[$k];
                                $video->user_id = $subtype->user_id;
                                $video->name_ar = $request->names_ar[$k];
                                $video->name_en = $request->names_en[$k];
                                $video->description_en = $request->description_en[$k];
                                $video->description_ar = $request->description_ar[$k];
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($i);

                                $duration = $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $url = $i;
                                $video->size_video = $i->getSize() / 1024;
                                $url->move('uploads', time() . '.' . $url->getClientOriginalExtension());
                                $video->url = time() . '.' . $url->getClientOriginalExtension();

                                if ($request->pay) {
                                    if (array_key_exists($k, $request->pay)) {
                                        $video->paid = $request->pay[$k];
                                    } else {
                                        $video->paid = 0;
                                    }
                                }
                                if ($request->hasFile('images')) {
                                    $image = $request->images[$k];
                                    $image->move('uploads', time() . $image->getClientOriginalName());
                                    $video->image = time() . $request->images[$k]->getClientOriginalName();
                                }
                                if ($request->hasFile('pdf')) {
                                    $pdf = $request->pdf[$k];
                                    $pdf->move('uploads', time() . $pdf->getClientOriginalName());
                                    $video->pdf = time() . $request->pdf[$k]->getClientOriginalName();
                                }
                                if ($request->hasFile('boards')) {
                                    $board = $request->boards[$k];
                                    $board->move('uploads', time() . $board->getClientOriginalName());
                                    $video->board = time() . $request->boards[$k]->getClientOriginalName();
                                }
                                $video->subject_id = $subtype->subjects_id;
                                $video->year_id = $subtype->years_id;
                                $video->type_id = $subtype->type_id;
                                $video->subtype_id = $subtype->id;
                                if (auth()->user() && auth()->user()->isAdmin == 'admin') {
                                    $video->user_id = $subtype->user_id;
                                } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1) {
                                    $video->user_id = $subtype->user_id;
                                    $video->center_id = auth()->user()->id;
                                } elseif (Auth::user() && Auth::user()->is_student == 2) {
                                    $video->user_id = auth()->user()->id;
                                }
                                $video->save();
                            }
                            return response()->json(['success' => 'video upload']);} else {

                            $msg = 'لقد استهلكت 100% ';
                            return response()->json(['status' => false, 'errors' => $msg]);

                        }}}} elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1) {
                $paqauser = Paqa_User::with("paqa")->where("user_id", auth()->user()->id)->first();
                if ($paqauser == null) {
                    $msg = 'انت غير مشترك في باقه برجاء الاشتراك في باقه';
                    return response()->json(['status' => false, 'message' => $msg]);
                } elseif ($paqauser->expired_at == Carbon::now()->format('Y-m-d')) {
                    $msg = 'انتهت صلاحيه الباقه';
                    return response()->json(['status' => false, 'message' => $msg]);
                } else {
                    $videoall = Video::where('user_id', $request->user_id)->where('center_id', null)->
                        where('created_at', '>=', $paqauser->created_at)->pluck('size_video')->toArray();
                    if ($videoall > 0) {
                        $sizepaqa = $paqauser->paqa->size;
                        $sum = array_sum($videoall);
                        $gigasum = $sum / 1024 / 1024;
                        if ($sizepaqa > $gigasum) {
                            $subtype = new Subtype;
                            $subtype->order_number = $request->order_number;
                            $subtype->name_ar = $request->name_ar;
                            $subtype->name_en = $request->name_en;
                            $subtype->years_id = $type->years_id;
                            $subtype->subjects_id = $type->subjects_id;
                            $subtype->type_id = $type->id;
                            $subtype->user_id = $type->user_id;
                            $subtype->center_id = auth()->user()->id;
                            $subtype->points = $request->points;
                            $subtype->part_points = $request->part_points;
                            $subtype->description = $request->description;
                            if ($request->hasFile('image')) {

                                $image = $request->image;

                                $file = $image->getClientOriginalName();
                                $fileName = pathinfo($file, PATHINFO_FILENAME);
                                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                $image->move('uploads', $fileName . '_' . time() . '.' . $fileExtension);
                                $subtype->image = $fileName . '_' . time() . '.' . $fileExtension;

                            }if ($request->hasFile('intro')) {
                                $intro = $request->intro;
                                $intro->move('uploads', time() . '.' . $intro->getClientOriginalExtension());
                                $subtype->intro = time() . '.' . $intro->getClientOriginalExtension();
                            }if ($request->hasFile('part_paper')) {
                                $part_paper = $request->part_paper;
                                $part_paper->move('uploads', time() . '.' . $part_paper->getClientOriginalExtension());
                                $subtype->part_paper = time() . '.' . $part_paper->getClientOriginalExtension();
                            }if ($request->hasFile('notes')) {
                                $notes = $request->notes;
                                $notes->move('uploads', time() . '.' . $notes->getClientOriginalExtension());
                                $subtype->notes = time() . '.' . $notes->getClientOriginalExtension();
                            }
                            $subtype->save();
                            if ($request->tag_id) {
                                $subtype->tags()->attach($request->tag_id);
                            }

                            foreach ($request->url as $k => $i) {
                                $video = new Video;

                                $video->order_number = $request->order[$k];
                                $video->user_id = $subtype->user_id;
                                $video->name_ar = $request->names_ar[$k];
                                $video->name_en = $request->names_en[$k];
                                $video->description_en = $request->description_en[$k];
                                $video->description_ar = $request->description_ar[$k];
                                $getID3 = new \getID3;
                                $file = $getID3->analyze($i);

                                $duration = $file['playtime_seconds'];
                                $video->seconds = $duration;
                                $url = $i;
                                $url = $i;
                                $video->size_video = $i->getSize() / 1024;
                                $url->move('uploads', time() . '.' . $url->getClientOriginalExtension());
                                $video->url = time() . '.' . $url->getClientOriginalExtension();

                                if ($request->pay) {
                                    if (array_key_exists($k, $request->pay)) {
                                        $video->paid = $request->pay[$k];
                                    } else {
                                        $video->paid = 0;
                                    }
                                }
                                // $image = $request->images[$k];
                                // $image->move('uploads', time() . $image->getClientOriginalName());
                                // $video->image = time() . $request->images[$k]->getClientOriginalName();
                                if ($request->hasFile('pdf')) {
                                    $pdf = $request->pdf[$k];
                                    $pdf->move('uploads', time() . $pdf->getClientOriginalName());
                                    $video->pdf = time() . $request->pdf[$k]->getClientOriginalName();}
                                if ($request->hasFile('images')) {
                                    $image = $request->images[$k];
                                    $image->move('uploads', time() . $image->getClientOriginalName());
                                    $video->image = time() . $request->images[$k]->getClientOriginalName();
                                }

                                if ($request->hasFile('boards')) {
                                    $board = $request->boards[$k];
                                    $board->move('uploads', time() . $board->getClientOriginalName());
                                    $video->board = time() . $request->boards[$k]->getClientOriginalName();
                                }
                                $video->subject_id = $subtype->subjects_id;
                                $video->year_id = $subtype->years_id;
                                $video->type_id = $subtype->type_id;
                                $video->subtype_id = $subtype->id;
                                if (auth()->user() && auth()->user()->isAdmin == 'admin') {
                                    $video->user_id = $subtype->user_id;
                                } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1) {
                                    $video->user_id = $subtype->user_id;
                                    $video->center_id = auth()->user()->id;
                                } elseif (Auth::user() && Auth::user()->is_student == 2) {
                                    $video->user_id = auth()->user()->id;
                                }
                                $video->save();
                            }
                            return response()->json(['success' => 'video upload']);} else {

                            $msg = 'لقد استهلكت 100% ';
                            return response()->json(['status' => false, 'errors' => $msg]);

                        }
                    }
                }
            } elseif (Auth::user() && Auth::user()->is_student == 2) {

                $paqauser = Paqa_User::with("paqa")->where("user_id", auth()->user()->id)->first();
                if ($paqauser == null) {
                    $msg = 'انت غير مشترك في باقه برجاء الاشتراك في باقه';
                    return response()->json(['status' => false, 'message' => $msg]);
                } elseif ($paqauser->expired_at == Carbon::now()->format('Y-m-d')) {
                    $msg = 'انتهت صلاحيه الباقه';
                    return response()->json(['status' => false, 'message' => $msg]);
                } else {
                    $videoall = Video::where('user_id', auth()->user()->id)->where('center_id', null)->
                        where('created_at', '>=', $paqauser->created_at)->pluck('size_video')->toArray();
                    if ($videoall > 0) {
                        $sizepaqa = $paqauser->paqa->size;
                        $sum = array_sum($videoall);
                        $gigasum = $sum / 1024 / 1024;
                        $subtype = new Subtype;
                        $subtype->part_points = $request->part_points;
                        $subtype->order_number = $request->order_number;
                        $subtype->name_ar = $request->name_ar;
                        $subtype->name_en = $request->name_en;
                        $subtype->years_id = $type->years_id;
                        $subtype->subjects_id = $type->subjects_id;
                        $subtype->type_id = $type->id;
                        $subtype->user_id = auth()->user()->id;
                        $subtype->points = $request->points;
                        $subtype->description = $request->description;
                        if ($request->hasFile('image')) {

                            $image = $request->image;

                            $file = $image->getClientOriginalName();
                            $fileName = pathinfo($file, PATHINFO_FILENAME);
                            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                            $image->move('uploads', $fileName . '_' . time() . '.' . $fileExtension);
                            $subtype->image = $fileName . '_' . time() . '.' . $fileExtension;

                        }if ($request->hasFile('intro')) {
                            $intro = $request->intro;
                            $intro->move('uploads', time() . '.' . $intro->getClientOriginalExtension());
                            $subtype->intro = time() . '.' . $intro->getClientOriginalExtension();
                        }if ($request->hasFile('part_paper')) {
                            $part_paper = $request->part_paper;
                            $part_paper->move('uploads', time() . '.' . $part_paper->getClientOriginalExtension());
                            $subtype->part_paper = time() . '.' . $part_paper->getClientOriginalExtension();
                        }if ($request->hasFile('notes')) {
                            $notes = $request->notes;
                            $notes->move('uploads', time() . '.' . $notes->getClientOriginalExtension());
                            $subtype->notes = time() . '.' . $notes->getClientOriginalExtension();
                        }
                        $subtype->save();

                        if ($request->tag_id) {
                            $subtype->tags()->attach($request->tag_id);
                        }
                        foreach ($request->url as $k => $i) {
                            $video = new Video;
                            $video->order_number = $request->order[$k];
                            $video->user_id = $subtype->user_id;
                            $video->name_ar = $request->names_ar[$k];
                            $video->name_en = $request->names_en[$k];
                            $video->description_en = $request->description_en[$k];
                            $video->description_ar = $request->description_ar[$k];
                            $getID3 = new \getID3;
                            $file = $getID3->analyze($i);

                            $duration = $file['playtime_seconds'];
                            $video->seconds = $duration;
                            $url = $i;
                            $url = $i;
                            $video->size_video = $i->getSize() / 1024;
                            $url->move('uploads', time() . '.' . $url->getClientOriginalExtension());
                            $video->url = time() . '.' . $url->getClientOriginalExtension();

                            if ($request->pay) {
                                if (array_key_exists($k, $request->pay)) {
                                    $video->paid = $request->pay[$k];
                                } else {
                                    $video->paid = 0;
                                }
                            }
                            if ($request->hasFile('images')) {
                                $image = $request->images[$k];
                                $image->move('uploads', time() . $image->getClientOriginalName());
                                $video->image = time() . $request->images[$k]->getClientOriginalName();
                            }
                            if ($request->hasFile('pdf')) {
                                $pdf = $request->pdf[$k];
                                $pdf->move('uploads', time() . $pdf->getClientOriginalName());
                                $video->pdf = time() . $request->pdf[$k]->getClientOriginalName();
                            }
                            if ($request->hasFile('boards')) {
                                $board = $request->boards[$k];
                                $board->move('uploads', time() . $board->getClientOriginalName());
                                $video->board = time() . $request->boards[$k]->getClientOriginalName();
                            }
                            $video->subject_id = $subtype->subjects_id;
                            $video->year_id = $subtype->years_id;
                            $video->type_id = $subtype->type_id;
                            $video->subtype_id = $subtype->id;
                            if (auth()->user() && auth()->user()->isAdmin == 'admin') {
                                $video->user_id = $subtype->user_id;
                            } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1) {
                                $video->user_id = $subtype->user_id;
                                $video->center_id = auth()->user()->id;
                            } elseif (Auth::user() && Auth::user()->is_student == 2) {
                                $video->user_id = auth()->user()->id;
                            }
                            $video->save();
                        }
                        return response()->json(['success' => 'video upload']);} else {

                        $msg = 'لقد استهلكت 100% ';
                        return response()->json(['status' => false, 'errors' => $msg]);

                    }
                }
            }

        }
    }

    public function editsubtype($id)
    {
        if (Auth::user() && Auth::user()->isAdmin == 'admin') {
            $users = User::where('is_student', 2)->get();
            $types = Type::all();
            $subjects = Subject::all();
            $years = Year::all();
        } else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1) {
            $users = User::where('id', Auth::user()->id)->first()->teachers;
            $types = Type::where('center_id', Auth::user()->id)->get();
            $subjects = Subject::all();
            $years = Year::all();
        } else if (Auth::user() && Auth::user()->is_student == 2) {
            $users = "";
            $subjects = auth()->user()->subjects;
            $types = Type::where('user_id', Auth::user()->id)->where('center_id', null)->get();
            $years = auth()->user()->years;
        }
        $tags = Tag::all();
        return view('dashboard.editsubtype')->with('years', $years)->
            with('subjects', $subjects)->with('types', Type::all())->
            with('subtype', Subtype::where('id', $id)->first())->with('types', $types)->with('users', $users)->with("tags", $tags);
    }
    public function updatesubtype($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            //     'image' => 'mimes:jpeg,jpg,png,gif',
            //   'intro' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi'
        ], [
            'required' => 'هذا الحقل مطلوب',
            'mimetypes' => 'هذا الحقل يقبل فيديو فقط',
            'mimes' => 'هذا الحقل يقبل صوره فقط',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $subtype = Subtype::where('id', $id)->first();
        if ($request->tag_id) {
            $subtype->tags()->sync($request->tag_id);
        }
        $subtype->part_points = $request->part_points;
        $subtype->order_number = $request->order_number;
        if (Auth::user() && Auth::user()->isAdmin == 'admin') {
            $subtype->points = $request->points;
            $subtype->name_ar = $request->name_ar;
            $subtype->name_en = $request->name_en;
            $subtype->description = $request->description;
            if ($request->hasFile('image')) {
                $link = public_path() . '/uploads/' . $subtype->image;
                File::delete($link);
                $image = $request->image;

                $file = $image->getClientOriginalName();
                $fileName = pathinfo($file, PATHINFO_FILENAME);
                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                $image->move('uploads', $fileName . '_' . time() . '.' . $fileExtension);
                $subtype->image = $fileName . '_' . time() . '.' . $fileExtension;

            }if ($request->hasFile('intro')) {if (public_path() . '/uploads/' . $subtype->intro) {
                $link = public_path() . '/uploads/' . $subtype->intro;
                File::delete($link);}
                $intro = $request->intro;
                $intro->move('uploads', time() . '.' . $intro->getClientOriginalExtension());
                $subtype->intro = time() . '.' . $intro->getClientOriginalExtension();
            }if ($request->hasFile('part_paper')) {
                if (public_path() . '/uploads/' . $subtype->part_paper) {
                    $link = public_path() . '/uploads/' . $subtype->part_paper;
                    File::delete($link);}
                $part_paper = $request->part_paper;
                $part_paper->move('uploads', time() . '.' . $part_paper->getClientOriginalExtension());
                $subtype->part_paper = time() . '.' . $part_paper->getClientOriginalExtension();
            }if ($request->hasFile('notes')) {
                if (public_path() . '/uploads/' . $subtype->notes) {
                    $link = public_path() . '/uploads/' . $subtype->notes;
                    File::delete($link);}
                $notes = $request->notes;
                $notes->move('uploads', time() . '.' . $notes->getClientOriginalExtension());
                $subtype->notes = time() . '.' . $notes->getClientOriginalExtension();
            }
            $subtype->save();
        } elseif (Auth::user() && Auth::user()->is_student == 2) {

            $subtype->name_ar = $request->name_ar;
            $subtype->name_en = $request->name_en;
            $subtype->points = $request->points;
            $subtype->description = $request->description;
            if ($request->hasFile('image')) {
                $link = public_path() . '/uploads/' . $subtype->image;
                File::delete($link);
                $image = $request->image;

                $file = $image->getClientOriginalName();
                $fileName = pathinfo($file, PATHINFO_FILENAME);
                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                $image->move('uploads', $fileName . '_' . time() . '.' . $fileExtension);
                $subtype->image = $fileName . '_' . time() . '.' . $fileExtension;

            }if ($request->hasFile('intro')) {
                if (public_path() . '/uploads/' . $subtype->intro) {
                    $link = public_path() . '/uploads/' . $subtype->intro;
                    File::delete($link);}
                $intro = $request->intro;
                $intro->move('uploads', time() . '.' . $intro->getClientOriginalExtension());
                $subtype->intro = time() . '.' . $intro->getClientOriginalExtension();
            }if ($request->hasFile('part_paper')) {
                if (public_path() . '/uploads/' . $subtype->part_paper) {
                    $link = public_path() . '/uploads/' . $subtype->part_paper;
                    unlink($link);}
                $part = $request->part_paper;
                $part->move('uploads', time() . '.' . $part->getClientOriginalExtension());
                $subtype->part_paper = time() . '.' . $part->getClientOriginalExtension();
            }if ($request->hasFile('notes')) {
                if (public_path() . '/uploads/' . $subtype->notes) {
                    $link = public_path() . '/uploads/' . $subtype->notes;
                    File::delete($link);}
                $notes = $request->notes;
                $notes->move('uploads', time() . '.' . $notes->getClientOriginalExtension());
                $subtype->notes = time() . '.' . $notes->getClientOriginalExtension();
            }
            $subtype->save();
        } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1) {

            $subtype->name_ar = $request->name_ar;
            $subtype->name_en = $request->name_en;
            $subtype->points = $request->points;
            $subtype->description = $request->description;
            $subtype->center_id = auth()->user()->id;
            if ($request->hasFile('image')) {
                if (public_path() . '/uploads/' . $subtype->intro) {
                    $link = public_path() . '/uploads/' . $subtype->image;
                    File::delete($link);}
                $image = $request->image;

                $file = $image->getClientOriginalName();
                $fileName = pathinfo($file, PATHINFO_FILENAME);
                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                $image->move('uploads', $fileName . '_' . time() . '.' . $fileExtension);
                $subtype->image = $fileName . '_' . time() . '.' . $fileExtension;

            }if ($request->hasFile('intro')) {
                if (public_path() . '/uploads/' . $subtype->intro) {
                    $link = public_path() . '/uploads/' . $subtype->intro;
                    File::delete($link);}
                $intro = $request->intro;
                $intro->move('uploads', time() . '.' . $intro->getClientOriginalExtension());
                $subtype->intro = time() . '.' . $intro->getClientOriginalExtension();
            }

            if ($request->hasFile('notes')) {
                if (public_path() . '/uploads/' . $subtype->notes) {
                    $link = public_path() . '/uploads/' . $subtype->notes;
                    File::delete($link);}
                $notes = $request->notes;
                $notes->move('uploads', time() . '.' . $notes->getClientOriginalExtension());
                $subtype->notes = time() . '.' . $notes->getClientOriginalExtension();
            }
            if ($request->hasFile('part_paper')) {
                if (public_path() . '/uploads/' . $subtype->part_paper) {
                    $link = public_path() . '/uploads/' . $subtype->part_paper;
                    File::delete($link);}
                $part_paper = $request->part_paper;
                $part_paper->move('uploads', time() . '.' . $part_paper->getClientOriginalExtension());
                $subtype->part_paper = time() . '.' . $part_paper->getClientOriginalExtension();
            }

            $subtype->save();
        }
        return response()->json(['success' => 'video upload']);
    }public function getsubtype($id)
    {
        $subtypes = Subtype::where('type_id', $id)->get();
        $text = "";
        $text .= '<option value="0"   disabled>اختر قسم فرعى</option>';
        foreach ($subtypes as $subtype) {
            $text .= '<option value="' . $subtype->id . '">' . $subtype->name_ar . '</option>';
        }
        return response()->json($text);
    }public function activesubtype($id)
    {
        $subtype = Subtype::where('id', $id)->first();
        if ($subtype->active == 1) {
            $subtype->active = 0;
            $subtype->save();
            return response(['status' => 'deactive']);
        } else if ($subtype->active == 0) {
            $subtype->active = 1;
            $subtype->save();
            return response(['status' => 'active']);
        }
    }public function subtypeattendstudents($id)
    {
        $subtype = Subtype::where('id', $id)->first();
        return view('dashboard.attendstudents.subtypeattendstudents')->with('subtype', $subtype);
    }
}
