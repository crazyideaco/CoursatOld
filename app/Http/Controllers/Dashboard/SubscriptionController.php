<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Admin\TypeCollegeSubscriptionDataTable;
use App\DataTables\Admin\TypeSubscriptionDataTable;
use App\Http\Controllers\Controller;
use App\Stage;
use App\University;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    protected $view = "dashboard.students.subscriptions.";
    public function typescollegeStudentSubscription(TypeCollegeSubscriptionDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'typeCollege', [
            "universities" => University::all(),
        ]);
    }

    public function typesStudentSubscription(TypeSubscriptionDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'type', [
            "stage" => Stage::all(),
        ]);
    }

    // }


    // public function addtypesollegestudent(Request $request, $id)
    // {
    //     $arr = [];
    //     array_push($arr, $id);
    //     $type =  TypesCollege::where('id', $request->course_id)->first();
    //     $type->studentscollege()->attach($arr);
    //     return response()->json(['status' => true]);
    // }
    // public function addtypestudent($id)
    // {
    //     $arr = [];
    //     array_push($arr, $id);

    //     $type =  Type::where('id', $request->course_id)->first();
    //     $type->studentstype()->attach($arr);
    //     return response()->json(['status' => true]);
    // }
}//End of controller
