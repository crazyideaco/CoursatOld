<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Admin\TypeCollegeSubscriptionDataTable;
use App\DataTables\Admin\TypeSubscriptionDataTable;
use App\DataTables\SystemSettings\CampainSubscriptionBasicDataTable;
use App\DataTables\SystemSettings\CampainSubscriptionCollegeDataTable;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Stage;
use App\University;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    protected $view = "dashboard.students.";
    protected $studentSubView = "dashboard.Campaigns.subscription.";
    public function typescollegeStudentSubscription(TypeCollegeSubscriptionDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'college_subscriptions.index', [
            "universities" => University::all(),
        ]);
    }

    public function typesStudentSubscription(TypeSubscriptionDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'basic_subscriptions.index', [
            "stages" => Stage::all(),
        ]);
    }


    public function subscribtions(CampainSubscriptionBasicDataTable $dataTableBasic, CampainSubscriptionCollegeDataTable $dataTableCollege, $id)
    {

        $campain =  Campaign::where("id", $id)->first();

        if ($campain->category_id == 1) {
            return $dataTableBasic->with(["campain" => $campain])->render($this->studentSubView . 'index', [
                "campain" => $campain,
            ]);
        }else {
            return $dataTableCollege->with(["campain" => $campain])->render($this->studentSubView . 'index', [
                "campain" => $campain,
            ]);
        }
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
