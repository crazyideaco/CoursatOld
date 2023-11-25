<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Resources\TagResource;
use App\Http\Resources\OfferResource;
use App\Tag;
use App\Offer;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseCodeResource;
use App\Models\QrCode;
use App\Traits\ApiTrait;
use App\Type;
use App\TypesCollege;
use App\User;
use Carbon\Carbon;
use Validator;
use App\Models\SecuritySetting;

class CourseCodeController extends Controller
{
    use ApiTrait;
    public function course_code_status(Request $request)
    {
        try {
            $rules = [
                "course_id" => "required",
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->getvalidationErrors($validator);
            }

            $user = auth()->user();


            if (auth()->user()->category_id == 1) {
                $type1 = Type::where('id', $request->course_id)->first();
                if ($type1) {
                    $security = SecuritySetting::whereTypeableId($request->course_id)->whereTypeableType(Type::class)->first();
                    if($security){
                        return response()->json([
                        'status' => true,
                        'message' => 'course_code_status',
                        'data' => new CourseCodeResource($security),
                    ]);
                    }else{
                        return response()->json([
                            'status' => true,
                            'message' => 'course_code_status',
                            'data' =>[
                                "id" => 0,
                                "secure"=> 1,
                                "show_video_code"=> 0,
                                "video_code_type"=> 0,
                                "code_duration"=> 0
                            ],
                        ]);
                    }


                } else {
                    return response()->json([
                        'status' => false, 'message' => 'لا يوجد كورس با ال الاسم',
                    ]);
                }
            } else if (auth()->user()->category_id == 2) {
                $type1 = TypesCollege::where('id', $request->course_id)->first();
                if ($type1) {
                    $security = SecuritySetting::whereTypeableId($request->course_id)->whereTypeableType(TypesCollege::class)->first();

                    if($security){
                        return response()->json([
                        'status' => true,
                        'message' => 'course_code_status',
                        'data' => new CourseCodeResource($security),
                    ]);
                    }else{
                        return response()->json([
                            'status' => true,
                            'message' => 'course_code_status',
                            'data' =>[
                                "id" => 0,
                                "secure"=> 1,
                                "show_video_code"=> 0,
                                "video_code_type"=> 0,
                                "code_duration"=> 0
                            ],
                        ]);
                    }


                } else {
                    return response()->json([
                        'status' => false, 'message' => 'لا يجد كور بهذا ال الاسم',
                    ]);
                }
            }
        } catch (\Exception $ex) {

            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
