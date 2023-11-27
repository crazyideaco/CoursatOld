<?php

namespace App\Http\Controllers;

use App\DataTables\Admin\PatchDataTable;
use App\DataTables\Admin\QrCodeDataTable;
use App\DataTables\Admin\TypeCollegeJoinDataTable;
use App\DataTables\Admin\TypeJoinDataTable;
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
use App\Stage;
use App\University;

class NewTypeCollegeJoinController extends Controller
{
    use ApiTrait;
    protected $view = 'dashboard.new_typecollege_joins.';
    protected $route = 'new_typecollege_joins.';


    public function index(TypeCollegeJoinDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');
    }



}
