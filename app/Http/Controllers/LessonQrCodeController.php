<?php

namespace App\Http\Controllers;

use App\DataTables\Admin\LessonPatchDataTable;
use App\DataTables\Admin\PatchDataTable;
use App\DataTables\Admin\QrCodeDataTable;
use App\Http\Controllers\Controller;
use App\Models\Course\Course;
use App\Models\Patch;
use App\Models\QrCode as QrCodeModel;
use App\Services\QrcodeService;
use App\Traits\ApiTrait;
use App\Type;
use App\TypesCollege;
use App\Lesson;
use App\User;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LessonQrCodeController extends Controller
{
    use ApiTrait;
    protected $view = 'dashboard.types.';
    protected $route = 'types.';

    protected  QrcodeService $qrcodeService;

    public function __construct(QrcodeService $qrcodeService)
    {
        $this->qrcodeService = $qrcodeService;
    }
    public function patch_index(LessonPatchDataTable $dataTable, $id)
    {
        $course = Lesson::whereId($id)->firstorFail();
        $dataTable->id = $id;
        return $dataTable->render($this->view . 'lesson_patches', compact('id', 'course'));
    }

    // public function index(QrCodeDataTable $dataTable, $id)
    // {
    //     $patch = Patch::whereId($id)->firstorFail();
    //     $dataTable->id = $id;
    //     return $dataTable->render($this->view . 'qrcodes', compact('id', 'patch'));
    // }


    public function store(Request $request)
    {
        $data = $this->qrcodeService->store($request,Lesson::class,'Lesson');
        return  $data;
    }


}
