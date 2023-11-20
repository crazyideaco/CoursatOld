<?php

namespace App\Http\Controllers\api\Student;

use App\Http\Controllers\Controller;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    use ApiTrait;

    public function switchCenter (Request $request) {
        $user = auth()->user();
        $rules = [
            "key" => "required|integer|between:1,2",
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first(), 400);
        }
        $user->is_public_platform_or_private_platform = (int)$request->key;

        $user->save();
        return $this->successResponse("User was updated");

    }


}
