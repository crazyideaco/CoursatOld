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

    /**
     * Retrieves the basic subscription data for a campaign.
     *
     * @param CampainSubscriptionBasicDataTable $dataTable The data table used to retrieve the subscription data.
     * @param int $id The ID of the campaign.
     * @return string The rendered view of the subscription data.
     */
    public function subscribtionsBasic(CampainSubscriptionBasicDataTable $dataTable, $id)
    {

        $campain =  Campaign::where("id", $id)->first();
        return $dataTable->with(["campain" => $campain])->render($this->studentSubView . 'index', [
            "campain" => $campain,
        ]);
    }

    /**
     * Retrieves the subscriptions for a specific college campaign.
     *
     * @param CampainSubscriptionCollegeDataTable $dataTable The data table instance for retrieving the subscriptions.
     * @param int $id The ID of the college campaign.
     * @return \Illuminate\Http\Response The rendered view of the student subscription index with the college campaign.
     */
    public function subscribtionsCollege(CampainSubscriptionCollegeDataTable $dataTable, $id)
    {

        $campain =  Campaign::where("id", $id)->first();
        return $dataTable->with(["campain" => $campain])->render($this->studentSubView . 'index', [
            "campain" => $campain,
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
