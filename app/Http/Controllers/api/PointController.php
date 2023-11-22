<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PointRequest;
use App\Traits\ApiTrait;
use Validator;

class PointController extends Controller
{
    use ApiTrait;
    public function get_points()
    {
        $msg = "your points";
        return response()->json([
            "status" => true,
            "message" => $msg,
            "points" => intval(auth()->user()->points)
        ]);
    }

    public function buy_points(Request $request)
    {

        $rules = [
            "payment_method_id" => "required|exists:payment_ways,id",
            "points" => "required",
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return $this->getvalidationErrors($validator);
        }

        $data['user_id'] = auth()->id();
        $data['payment_way_id'] = $request->payment_method_id;
        $data['points'] = $request->points;
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image->move('uploads', time() . '.' . $image->getClientOriginalExtension());
            $point_image = time() . '.' . $image->getClientOriginalExtension();
            $data['image'] = base64_decode($point_image);
        }

        PointRequest::create($data);
        $msg = "buy_points";
        return response()->json([
            "status" => true,
            "message" => $msg,
        ]);
    }
}
