<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Resources\TagResource;
use App\Http\Resources\OfferResource;
use App\Tag;
use App\Offer;

use App\Http\Controllers\Controller;
use App\Models\QrCode;
use App\Traits\ApiTrait;
use App\Type;
use App\TypesCollege;
use App\User;
use Carbon\Carbon;
use Validator;

class QrController extends Controller
{
    use ApiTrait;
    public function join_by_qr(Request $request){
        try{
            $rules = [
                "qr" => "required|exists:qr_codes,qrcode",
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->getvalidationErrors($validator);
            }

            $Qrcode = QrCode::where('qrcode', $request->qr)->first();
            // if($request->user_id){
            //     $user = User::whereId($request->user_id)->first();
            // }else{
                $user = auth()->user();
            // }
            if($Qrcode->status == 1){
                $msg = '.sorry, this code expired';
                return $this->errorResponse($msg , 200);
            }
            if($Qrcode->status == 2){
                $msg = 'sorry, you bought this course before';
                return $this->errorResponse($msg , 200);
            }
            if($Qrcode->expire_date < Carbon::now()){
                $msg = 'sorry, this code expired';
                return $this->errorResponse($msg , 200);
                $Qrcode->update(['status' => 1]);
            }


            if ($user->category_id == 1) {
                if($Qrcode->typeable_type != 'App\Type'){
                $msg = '.sorry, this code invalid';
                return $this->errorResponse($msg , 200);
            }else{
               $type = Type::where('id', $Qrcode->typeable_id)->first();

                if ($type) {
                        $user->stutypes()->attach($type->id);
                    $user->stutypes()->updateExistingPivot($type->id, ['type' => 3]);

                        $Qrcode->update(['status' => 2]);
                        return response()->json([
                            'status' => true,
                            'message' => 'تم شر الكورس',
                        ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'عفوا   لايجد كرس هذا الاسم',
                    ]);
                }
            }

            } else if ($user->category_id == 2) {
                if($Qrcode->typeable_type != 'App\TypesCollege'){
                    $msg = '.sorry, this code invalid';
                    return $this->errorResponse($msg , 200);
                }else{
                $type = TypesCollege::where('id', $Qrcode->typeable_id)->first();
                if ($type) {

                        $user->stutypescollege()->attach($type->id);
                    $user->stutypescollege()->updateExistingPivot($type->id, ['type' => 3]);

                        $Qrcode->update(['status' => 2]);
                        return response()->json([
                            'status' => true,
                            'message' => 'تم شرء اكورس',
                        ]);
                    } else {
                        return response()->json([
                            'status' => false,
                            'message' => 'عفو لاتمل نقاط كافيه',
                        ]);
                    }

            }
            }


        } catch (\Exception $ex) {

            return $this->returnException($ex->getMessage(), 500);

        }
    }
}
