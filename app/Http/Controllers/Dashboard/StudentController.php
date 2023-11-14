<?php

namespace App\Http\Controllers\Dashboard;

use App\College;
use App\DataTables\Admin\StudentDataTable;
use App\Division;
use App\Http\Controllers\Controller;
use App\Section;
use App\Services\AuthDataService;
use App\Stage;
use App\University;
use App\User;
use App\Year;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $view = "dashboard.students.";
    public function allstudents(StudentDataTable $dataTable)
    {

        return $dataTable->render($this->view . 'index',[
            "stages" => Stage::all(),
            // "years" => Year::all(),
            "universities" => University::all(),
            // "colleges" => College::all(),
            // "divisions" => Division::all(),
            // "sections" => Section::all(),
        ]);
    }

    

    /**
     * year_id
     * subjects_id
    */

    // public function basicstudents()
    // {
    //     $students = User::where('is_student', 1)->whereNotNull("name")
    //     ->whereNotNull("year_id")->get();
    //     $auth_service = new AuthDataService();
    //     $types = $auth_service->getAuthType();
    //     return view('dashboard.students.basicstudents', compact('students', "types"))
    //     ->with('stages', Stage::all());
    // }

    // public function collegestudents()
    // {
    //     $students = User::where('is_student', 1)->whereNotNull("name")
    //     ->whereNotNull("section_id")->get();
    //     $divisions = Division::all();
    //     $sections = Section::all();
    //     return view('dashboard.students.collegestudents', compact('students'))
    //     ->with('colleges', College::all())
    //     ->with('divisions', $divisions)
    //     ->with('sections', $sections)
    //     ->with('universities', University::all());
    // }
}//End of controller
