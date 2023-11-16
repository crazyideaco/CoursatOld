<?php

namespace App\Http\Controllers;

use App\DataTables\Admin\PatchDataTable;
use App\DataTables\Admin\QrCodeDataTable;
use App\DataTables\Admin\SubTypePatchDataTable;
use App\Http\Controllers\Controller;
use App\Models\Course\Course;
use App\Models\Patch;
use App\Models\QrCode as QrCodeModel;
use App\Services\QrcodeService;
use App\Traits\ApiTrait;
use App\Type;
use App\TypesCollege;
use App\Subtype;
use App\User;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SubTypeQrCodeController extends Controller
{
    use ApiTrait;
    protected $view = 'dashboard.types.';
    protected $route = 'types.';

    protected  QrcodeService $qrcodeService;

    public function __construct(QrcodeService $qrcodeService)
    {
        $this->qrcodeService = $qrcodeService;
    }
    public function subtype_patch_index(SubTypePatchDataTable $dataTable, $id)
    {
        $course = Subtype::whereId($id)->firstorFail();
        $dataTable->id = $id;
        return $dataTable->render($this->view . 'subtype_patches', compact('id', 'course'));
    }

    // public function index(QrCodeDataTable $dataTable, $id)
    // {
    //     $patch = Patch::whereId($id)->firstorFail();
    //     $dataTable->id = $id;
    //     return $dataTable->render($this->view . 'qrcodes', compact('id', 'patch'));
    // }


    public function store(Request $request)
    {
        $data = $this->qrcodeService->store($request,Subtype::class,'SubType');
        return  $data;
    }


}
