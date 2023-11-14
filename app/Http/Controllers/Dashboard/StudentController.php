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
        return $dataTable->render($this->view . 'index');
    }

}//End of controller
