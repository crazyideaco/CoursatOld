<?php

namespace App\Traits;

use Image;
use Illuminate\Support\Facades\File;

trait ApiTrait
{

    public function errorResponse($msg, $code=404)
    {
        return response()->json([
            'status' => false,
            'message' => $msg,
        ], $code);
    }

    public function successResponse($msg, $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $msg,
        ], $code);
    }

    public function dataResponse($msg, $data, $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $msg,
            'data' => $data,
        ], $code);
    }

    public function getvalidationErrors($validator, $code = 422)
    {
        return $this->errorResponse($validator->errors()->first(), $code);
    }
    
    public function returnException($message, $code)
    {
        return $this->errorResponse($message, $code);
    }
}//End of trait
