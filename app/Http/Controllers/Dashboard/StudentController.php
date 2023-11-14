<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Admin\StudentDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $view = "dashboard.students.";
    public function allstudents(StudentDataTable $dataTable)
    {
        // $students = User::where('is_student', 1)->where('name', '<>', NULL)->select("name", "id", "code", "phone", "year_id")->get();
        return $dataTable->render($this->view . 'index');
        // return view('dashboard.students')->with('students', $students);
    }

}//End of controller
