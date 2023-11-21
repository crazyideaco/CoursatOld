<?php

namespace App\Http\Controllers;

use App\DataTables\Admin\PatchDataTable;
use App\DataTables\Admin\QrCodeDataTable;
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

class TypeSubscriptionController extends Controller
{
    use ApiTrait;
    protected $view = 'dashboard.type_subscribtions.';
    protected $route = 'type_subscribtions.';


    public function index(TypeSubscriptionDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');
    }



}
