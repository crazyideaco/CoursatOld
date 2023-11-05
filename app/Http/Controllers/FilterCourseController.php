<?php
namespace App\Http\Controllers;

use App\College;
use App\Course;
use App\Division;
use App\General;
use App\Section;
use App\Sub;
use App\Subject;
use App\SubjectsCollege;
use App\Type;
use App\TypesCollege;
use App\University;
use App\User;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilterCourseController extends Controller
{
    public function filtertypes(Request $request)
    {
        if (Auth::user() && Auth::user()->isAdmin == 'admin') {
            $types = Type::orderBy('created_at', 'desc');
        } else if (Auth::user() && Auth::user()->is_student == 2) {
            $types = Type::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id);
        } else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id = 1) {
            $types = Type::orderBy('created_at', 'desc')->where('center_id', Auth::user()->id);
        }
        if ($request->years_id && $request->subjects_id) {
            $types = $types->where('subjects_id', $request->subjects_id)->get();
        } else if ($request->years_id) {
            $types = $types->where('years_id', $request->years_id)->get();
        } else {

            $types = $types->get();
        }
        $text = "";
        foreach ($types as $type) {
            $text .= '<tr id="type' . $type->id . '">
					  <td class="text-center">' . $type->id . '</td>
                    <td scope="row" class="text-center"><a href="' . route("subtypes", $type->id) . '">' . $type->name_ar . '</a></td>
                      <td class="text-center">';
            if ($type->user) {
                $text .= $type->user->name;
            }
            $text .= '</td>
                        <td class="text-center">';
            if ($type->subject) {
                $text .= $type->subject->name_ar;
            }
            $text .= '</td>
                          <td class="text-center">';
            if ($type->year) {
                $text .= $type->year->year_ar;
            }
            $text .= '</td>
                        <td class="text-center">
                          <a href="' . route("edittype", $type->id) . '"> <img src="' . asset("images/pen.svg") . '" id="pen"
                         style="cursor: pointer"></a>
                             <img src="' . asset("images/trash.svg") . '" id="trash" onclick="deletetype(' . $type->id . ')" style="cursor:pointer;">
                         <span class="btn bg-success btn-success text-white btn-sm" id="btn' . $type->id . '" onclick="activetype(' . $type->id . ')">';
            if ($type->active == 1) {
                $text .= "الغاء التفعيل";
            } else {
                $text .= "تفعيل";
            }

            $text .= '</span>
                           <a href="' . route("grouptypes", $type->id) . '" class="btn btn-success btn-sm" >المجموعات</a>
                           <a href="' . route("typeexams", $type->id) . '" class="btn btn-success btn-sm" >الامتحانات</a>
                                            </td>
                                        </tr>';
        }
        return response()->json(['status' => true, 'data' => $text]);
    }public function filtertypescollege(Request $request)
    {
        // dd($request->all());
        // if($request->university_id && $request->college_id && $request->division_id &&  $request->section_id && $request->subjectscollege_id){
        //      $typescolleges = TypesCollege::where("subjectscollege_id",$request->subjectscollege_id)->get();
        // }elseif($request->university_id && $request->college_id && $request->division_id && $request->section_id){
        //      $typescolleges = TypesCollege::where("section_id",$request->section_id)->get();
        // }elseif($request->university_id && $request->college_id && $request->division_id){
        //      $typescolleges = TypesCollege::where("division_id",$request->division_id)->get();
        // }elseif($request->university_id && $request->college_id){
        //      $typescolleges = TypesCollege::where("college_id",$request->college_id)->get();
        // }elseif($request->university_id){
        //      $typescolleges = TypesCollege::where("university_id",$request->university_id)->get();
        // }else{
        //   $typescolleges = TypesCollege::all();
        // }
        if (Auth::user() && Auth::user()->isAdmin == 'admin') {
            $typescolleges = TypesCollege::where(function ($query) use ($request) {
                $query->when($request->university_id != 0, function ($q) use ($request) {
                    return $q->where("university_id", $request->university_id);
                });
                $query->when($request->college_id != 0, function ($q) use ($request) {
                    return $q->where("college_id", $request->college_id);
                });
                $query->when($request->division_id != 0, function ($q) use ($request) {
                    return $q->where("division_id", $request->division_id);
                });
                $query->when($request->section_id != 0, function ($q) use ($request) {
                    return $q->where("section_id", $request->section_id);
                }); $query->when($request->subjectscollege_id != 0, function ($q) use ($request) {
                    return $q->where("subjectscollege_id", $request->subjectscollege_id);
                });
            })->get();
        } else if (Auth::user() && Auth::user()->is_student == 3) {
            $typescolleges = TypesCollege::where("doctor_id", auth()->id())->where(function ($query) use ($request) {
                $query->when($request->university_id != 0, function ($q) use ($request) {
                    return $q->where("university_id", $request->university_id);
                });
                $query->when($request->college_id != 0, function ($q) use ($request) {
                    return $q->where("college_id", $request->college_id);
                });
                $query->when($request->division_id != 0, function ($q) use ($request) {
                    return $q->where("division_id", $request->division_id);
                });
                $query->when($request->section_id != 0, function ($q) use ($request) {
                    return $q->where("section_id", $request->section_id);
                }); $query->when($request->subjectscollege_id != 0, function ($q) use ($request) {
                    return $q->where("subjectscollege_id", $request->subjectscollege_id);
                });
            })->get();
        } elseif (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2) {
            $typescolleges = TypesCollege::where("center_id", auth()->id())->where(function ($query) use ($request) {
                $query->when($request->university_id != 0, function ($q) use ($request) {
                    return $q->where("university_id", $request->university_id);
                });
                $query->when($request->college_id != 0, function ($q) use ($request) {
                    return $q->where("college_id", $request->college_id);
                });
                $query->when($request->division_id != 0, function ($q) use ($request) {
                    return $q->where("division_id", $request->division_id);
                });
                $query->when($request->section_id != 0, function ($q) use ($request) {
                    return $q->where("section_id", $request->section_id);
                }); $query->when($request->subjectscollege_id != 0, function ($q) use ($request) {
                    return $q->where("subjectscollege_id", $request->subjectscollege_id);
                });
            })->get();
        }
        $text = "";
        foreach ($typescolleges as $typescollege) {
            $text .= '<tr id="un' . $typescollege->id . '">
						<td>' . $typescollege->id . '</td>
                          <td scope="row" class="text-center">
                   <a href="' . route("lessons", $typescollege) . '"> ' . $typescollege->name_ar . '</a></td>

                   <td scope="row" class="text-center">
                   ' . $typescollege->subjectscollege->name_ar . '</td>
                   <td scope="row" class="text-center">
                   ' . $typescollege->section->name_ar . '</td>
                <td scope="row" class="text-center">
                   ' . $typescollege->division->name_ar . '</td>
                    <td class="text-center">' . $typescollege->college->name_ar . '</td>
                          <td class="text-center">' . $typescollege->university->name_ar . '</td>
                        <td class="text-center">
                  <a href="' . route("edittypescollege", $typescollege->id) . '"> <img src="' . asset("images/pen.svg") . '" id="pen"
                         style="cursor: pointer"></a>
                           <span class="btn bg-success text-white btn-sm btning" id="now' . $typescollege->id . '" onclick="activetypecollege(' . $typescollege->id . ')">';

            if ($typescollege->active == 1) {
                $text .= "الغاء التفعيل";
            } else {
                $text .= "تفعيل";
            }
            $text .= '</span>
                           <a  href="' . route("groupstypescollege", $typescollege->id) . '" class="btn bg-success text-white btn-sm btning">المجموعات</a>
							 <img src="' . asset("images/trash.svg") . '" id="trash" onclick="deletetypescollege(' . $typescollege->id . ')" style="cursor:pointer;">
                              <a class="btn btn-primary btn-sm mt-2" href="' . route("typescollegeexams", $typescollege->id) . '">
                          الامتحانات
                         </a>
                                            </td>
                                        </tr>';
        }
        return response()->json(['status' => true, 'data' => $text]);
    }public function filtercourses(Request $request)
    {
        if ($request->sub_id) {
            $courses = Course::where("sub_id", $request->sub_id)->get();
        }
        $text = '';
        foreach ($courses as $course) {
            $text .= '<tr id="g' . $course->id . '">
						<!--<td class="text-center">' . $course->id . '</td>-->
                <td scope="row" class="text-center">
                 <a href="' . route("videosgeneral", $course->id) . '">  ' . $course->name_ar . '</a></td>
                    <td class="text-center">' . $course->user->name . '</td>
                       <td class="text-center">' . $course->general->name_ar . '</td>
                         <td class="text-center">' . $course->sub->name_ar . '</td>
                        <td class="text-center">
                  <a href="' . route("editcourse", $course->id) . '"> <img src="' . asset("images/pen.svg") . '" id="pen"
                         style="cursor: pointer"></a>
                           <img src="' . asset("images/trash.svg") . '" id="trash" onclick="deletecourse(' . $course->id . ')" style="cursor:pointer;">
                         <span class="btn bg-success text-white btn-sm" id="btn' . $course->id . '" onclick="activecourse(' . $course->id . ')">';
            if ($course->active == 1) {
                $text .= "الغاء التفعيل";
            } else {
                $text .= "تفعيل";
            }
            $text .= '</span>
                          <a  href="' . route('groupcourses', $course->id) . '" class="btn bg-success text-white btn-sm">المجموعات</a>
                             <a class="btn btn-primary btn-sm mt-2" href="' . route("courseexams", $course->id) . '">
                          الامتحانات
                         </a>
                           </td>
                                        </tr>';
        }
        return response()->json(['status' => true, 'data' => $text]);
    }
}
