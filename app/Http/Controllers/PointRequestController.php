<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\Point;
use App\City;
use App\Year;
use App\Subject;
use App\history;
use App\Subhistory;
use App\Video;
use Illuminate\Support\Facades\File;
use App\User;
use App\Offer;
use App\User_Year;
use Illuminate\Validation\Rule;
use App\Category;
use App\Stage;
use App\College;
use App\DataTables\Admin\PointHistoryDataTable;
use App\DataTables\Admin\PointRequestDataTable;
use App\DataTables\Admin\ReelDataTable;
use App\Division;
use App\Http\Requests\Reel\StoreRequest;
use App\Models\PointHistory;
use App\Models\PointRequest;
use App\Models\Reel;
use App\Models\ReelInformation;
use App\Section;
use App\SubjectsCollege;
use App\historysCollege;

use App\University;

use App\Student_historycollege;
use Illuminate\Support\Facades\Auth;

use App\Student_history;
use App\Paqa;
use App\Paqa_User;
use App\Services\AuthDataService;
use App\Student_Course;
use Illuminate\Support\Facades\Hash;
use App\historyexamResult;
use App\historyscollegeexamResult;
use App\historypoint;
use App\historycollegepoint;
use Illuminate\Support\Facades\DB;

class PointRequestController extends Controller
{
    protected $view = 'dashboard.point_requests.';
    protected $route = 'point_requests.';


    public function index(PointRequestDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');
    }
    public function pointhistory_index(PointHistoryDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'pointhistory_index');
    }

    public function accept_point_request($id)
    {
        $point = PointRequest::where("id", $id)->first();
        $history = new PointHistory;
        $history->user_id = $point->user_id;
        $history->points  = $point->points;
        $history->type  = 1 ;

        $history->save();
        
        $point->user_id  = auth()->id();
        $point->status = 1;
        $point->save();
        $msg = "تم القبول بنجاح";
        return response()->json(['status' => true, "message" => $msg]);
    }
    public function refuse_point_request($id)
    {
        $point = PointRequest::where("id", $id)->first();
        $point->user_id  = auth()->id();
        $point->status = 2;
        $point->save();
        $msg = "تم الرفض بنجاح";
        return response()->json(['status' => true, "message" => $msg]);
    }

}
