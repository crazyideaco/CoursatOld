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
use App\DataTables\Admin\ReelDataTable;
use App\Division;
use App\Http\Requests\Reel\StoreRequest;
use App\Models\Reel;
use App\Models\ReelInformation;
use App\Section;
use App\SubjectsCollege;
use App\TypesCollege;

use App\University;

use App\Student_Typecollege;
use Illuminate\Support\Facades\Auth;

use App\Student_Type;
use App\Paqa;
use App\Paqa_User;
use App\Services\AuthDataService;
use App\Student_Course;
use Illuminate\Support\Facades\Hash;
use App\TypeexamResult;
use App\TypescollegeexamResult;
use App\TypeJoin;
use App\TypecollegeJoin;
use Illuminate\Support\Facades\DB;

class ReelController extends Controller
{
    protected $view = 'dashboard.reels.';
    protected $route = 'reels.';


    public function index(ReelDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');
    }


    public function create()
    {
        $teachers = User::where("is_student", 2)->whereNotNull("name")->get();
        $doctors = User::where("is_student", 3)->whereNotNull("name")->get();

        $categories = Category::get();
        $stages = Stage::get();
        $years = Year::get();
        $subjects = Subject::get();
        $colleges = College::get();
        $divisions = Division::get();
        $sections = Section::get();
        $universities = University::get();

        $subjectscolleges = SubjectsCollege::get();


        return view($this->view . 'create',compact(
            'categories',
            'stages','years','subjects',
            'subjectscolleges',
            'universities','colleges',
            'sections','divisions'
            ,'teachers','doctors'
        ));
    }


    public function store(StoreRequest $request)
    {
        $data['name'] = $request->name;
        $data['category_id'] = $request->category_id;
        $data['video'] = $request->video;

        // if ($request->hasFile('video')) {
        //     $data["video"] = upload_video($request->video, "reels");
        // }

        if($request->hasFile('image'))
        {
        $image = $request->image;
        $image->move('uploads' ,time(). $image->getClientOriginalName());
        $data['image'] = time().$request->image->getClientOriginalName();
        }

        $reel = Reel::create($data);

        if($request->category_id == 1){

            $info_data['reel_id'] = $reel->id;
            $info_data['subject_id'] = $request->subject_id ?? null;
            $info_data['stage_id'] = $request->stage_id ?? null;
            $info_data['year_id'] = $request->year_id ?? null;
            $info_data['user_id'] = $request->teacher_id ?? null;

            ReelInformation::create($info_data);

        }   if($request->category_id == 2){

            $info_data['reel_id'] = $reel->id;
            $info_data['university_id'] = $request->university_id ?? null;
            $info_data['college_id'] = $request->college_id ?? null;
            $info_data['section_id'] = $request->section_id ?? null;
            $info_data['division_id'] = $request->division_id ?? null;
            $info_data['subjectscollege_id'] = $request->subjectscollege_id ?? null;
            $info_data['user_id'] = $request->doctor_id ?? null;

            ReelInformation::create($info_data);
        }

        return redirect()->route($this->route . "index")
            ->with(['success' => __("messages.createmessage")]);
    }


    public function edit(Reel $reel)
    {
        $teachers = User::where("is_student", 2)->whereNotNull("name")->get();
        $doctors = User::where("is_student", 3)->whereNotNull("name")->get();

        $categories = Category::get();
        $stages = Stage::get();
        $years = Year::get();
        $subjects = Subject::get();
        $colleges = College::get();
        $divisions = Division::get();
        $sections = Section::get();
        $universities = University::get();

        $subjectscolleges = SubjectsCollege::get();

        return view($this->view . 'edit', compact(
            'reel',
            'categories',
            'stages','years','subjects',
            'subjectscolleges',
            'universities','colleges',
            'sections','divisions'
            ,'teachers','doctors'
        ));
    }


    public function update(Request $request, $id)
    {
        $reel = Reel::whereId($id)->first();

        $data['name'] = $request->name;
        $data['category_id'] = $request->category_id;
        $data['video'] = $request->video;

        // if ($request->hasFile('video')) {
        //     delete_image($reel->video ?? '');
        //     $data["video"] = upload_video($request->video, "reels");
        // }

        if($request->hasFile('image'))
        {
        $image = $request->image;
        $image->move('uploads' ,time(). '.'.$image->getClientOriginalExtension());
        $data['image'] = time(). '.'.$image->getClientOriginalExtension();
        }

        $reel->update($data);
        if($request->category_id == 1){
            $info_data = [];
            $info_data['reel_id'] = $reel->id;
            $info_data['user_id'] = $request->teacher_id ?? null;

            $info_data['subject_id'] = $request->subject_id ?? null;
            $info_data['stage_id'] = $request->stage_id ?? null;
            $info_data['year_id'] = $request->year_id ?? null;
            $info_data['subjectscollege_id'] = null;
            $info_data['university_id'] = null;
            $info_data['college_id'] = null;
            $info_data['section_id'] = null;
            $info_data['division_id'] = null;
            $reel->informations()->update($info_data);

        }elseif($request->category_id == 2){

            $info_data = [];
            $info_data['reel_id'] = $reel->id;
            $info_data['user_id'] = $request->doctor_id ?? null;

            $info_data['subjectscollege_id'] = $request->subjectscollege_id ?? null;
            $info_data['university_id'] = $request->university_id ?? null;
            $info_data['college_id'] = $request->college_id ?? null;
            $info_data['section_id'] = $request->section_id ?? null;
            $info_data['division_id'] = $request->division_id ?? null;
            $info_data['subject_id'] =  null;
            $info_data['stage_id'] = null;
            $info_data['year_id'] = null;
            $reel->informations()->update($info_data);
        }
        return redirect()->route($this->route . "index")
            ->with(['success' => __("messages.editmessage")]);
    }


    public function destroy($id)
    {
        $reel = Reel::whereId($id)->first();
        if (public_path() . '/uploads/' . $reel->image) {
            $link = public_path() . '/uploads/' . $reel->image;
            File::delete($link);
        }
        $reel->informations->delete();

        $reel->delete();
        return response()->json(['status' => true]);
    }
}
