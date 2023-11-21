<?php

namespace App\Http\Controllers;

use App\DataTables\Admin\PatchDataTable;
use App\DataTables\Admin\QrCodeDataTable;
use App\DataTables\Admin\TypeCollegeSubscriptionDataTable;
use App\DataTables\Admin\TypeSubscriptionDataTable;
use App\Http\Controllers\Controller;
use App\Models\Course\Course;
use App\Models\Patch;
use App\Models\QrCode as QrCodeModel;
use App\Services\QrcodeService;
use App\Traits\ApiTrait;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TypeCollegeSubscriptionController extends Controller
{
    use ApiTrait;
    protected $view = 'dashboard.typecollege_subscribtions.';
    protected $route = 'typecollege_subscribtions.';


    public function index(TypeCollegeSubscriptionDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');
    }



}
