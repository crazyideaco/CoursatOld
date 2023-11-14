<?php

namespace App\Http\Controllers;

use App\DataTables\Admin\QrCodeDataTable;
use App\Http\Controllers\Controller;
use App\Models\Course\Course;
use App\Models\Patch;
use App\Models\QrCode as QrCodeModel;
use App\Type;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    protected $view = 'dashboard.types.';
    protected $route = 'types.';

    // public function patch_index(QrcodePatchDataTable $dataTable, $id)
    // {
    //     $course = course::whereId($id)->firstorFail();
    //     $dataTable->id = $id;
    //     return $dataTable->render($this->view . 'patches', compact('id', 'course'));
    // }

    // public function index(QrCodeDataTable $dataTable, $id)
    // {
    //     $qrcode_patch = QrcodePatch::whereId($id)->firstorFail();
    //     $dataTable->id = $id;
    //     return $dataTable->render($this->view . 'course_qrcodes', compact('id', 'qrcode_patch'));
    // }

    public function store(Request $request)
    {

        try {
            $rules['count'] = 'required|numeric';
            $rules['expire_date'] = 'required|date';
            $validator = validator($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
            }

            $returnedQrCode = [];

            $course = Type::whereId(request()->type_id)->first();
            $count = request()->count;

            // $patch = Patch::create([
            //     // 'course_id' => $course->id,
            //     'count' => $count,
            //     'createable_id' => auth()->id(),
            //     'createable_type' => AdminModel::class,
            // ]);

            for ($i = 0; $i < $count; $i++) {
                $generatedQrCode = QrCodeModel::create([
                'typeable_id' => request()->type_id,
                'typeable_type' => Type::class,

                    'user_id' => $course->user_id,
                    "expire_date" => $request->expire_date,
                    // "qrcode_patch_id" => $patch->id,
                    'qrcode' => rand(99999, 999999),
                ]);

                $returnedQrCode[] = $generatedQrCode;


            }
            $barcodes = [];



            // Loop through each QR code and generate the barcode.
            foreach ($returnedQrCode as $key => $qr) {
                $barcode = QrCode::encoding('UTF-8')->size(60)->generate($qr->qrcode);

                $name = $course->title . "<br/>" . $qr->qrcode;

                $bar = "<div class='row' style='width: 100%;
                    height: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: flex-start;
                    margin: 0;'>
                    <span class='col-4' >
                    " . $barcode . "
                    </span>
                    <span class='col-8'style='font-size: 12px' >" . $name . "</span>

                </div>";



                // Add the generated barcode to the $barcodes array.
                $barcodes[] = $bar;
            }


            $barcodeContent = implode("\n", $barcodes);


            return response()->json(['status' => true, 'message' => __('messages.successmessage') , "qrcodes" => $returnedQrCode, "html" => $barcodeContent
        ]);
        } catch (\Exception $ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
