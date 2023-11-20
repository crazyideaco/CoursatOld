<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\ClothResource;
use App\Http\Resources\TeacherResource;

use App\Http\Resources\OfferResource;

use App\Http\Resources\RateResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SofaResource;
use App\Http\Resources\ResourceSofa;
use App\Http\Resources\VideoResource;


use App\Notifications\SignupActivate;
use App\Model\Contact;
use App\Model\Countries_list;
use App\User;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index()
    {
        $is_student = \auth()->user()->is_student;
        if ($is_student == 2) {
            return response()->json(['status' => "false", 'message_en' => "ده مدرس مش طالب اسطا"], 401);
        }
        $offer = OfferResource::collection(\App\Offer::get());
        $data = CategoryResource::collection(\App\Subject::get());
        return response()->json(['offer' => $offer, 'data' => $data]);
    }

    public function teacher_video($id)
    {

        $user = User::where('id', $id)->first();
        $closet = VideoResource::collection(\App\Video::where('user_id', $user->id)->get());
        return response()->json(['status' => 'true', 'data' => $closet]);
    }

    public function teacher_video_paginate($id)
    {

        $user = User::where('id', $id)->first();
        $closet = VideoResource::collection(\App\Video::where('user_id', $user->id)->get()->take(5));
        return response()->json(['status' => 'true', 'data' => $closet]);
    }


    public function teacher_profile($id)
    {
        $user = new TeacherResource(User::where('id', $id)->first());


        return response()->json(['status' => 'true', 'data' => $user]);
    }

    public function view_all(Request $request)
    {



        $validator = Validato::make($request->all(), [

            'category_id' => 'required',
            "status" => 'required',

        ]);

        if ($validator->passes()) {

            if ($request->status == 1) {
                $user_year = \auth()->user()->year_id;

                $user_latitude = \auth()->user()->latitude;
                $user_longitude = \auth()->user()->longitude;

                $max_user_latitude = $user_latitude + 0.35;
                $min_user_latitude = $user_latitude - 0.35;

                $max_user_longitude = $user_longitude + 0.35;
                $min_user_longitude = $user_longitude - 0.35;

                $allclosetid = \App\User::where('is_student', 2)->where('latitude', '>', $min_user_latitude)->where('latitude', '<', $max_user_latitude)->where('longitude', '>', $min_user_longitude)->where('longitude', '<', $max_user_longitude)->pluck('id');



                return   VideoResource::collection(\App\Video::whereIn('user_id', $allclosetid)->where('year_id', $user_year)->where('subject_id', $request->category_id)->get());
            } else if ($request->status == 0) {

                $user_year = \auth()->user()->year_id;
                return VideoResource::collection(\App\Video::where('year_id', $user_year)->where('subject_id', $request->category_id)->latest()->take(10)->get());
            }


            ##################################################################################################
        } else {
            $msg = $validator->messages()->first();
            return response()->json(['status' => "false", 'message_en' => $msg], 401);
        }
    }

    public function subject_videos($id)
    {


        $videos = VideoResource::collection(\App\Video::where('subject_id', $id)->get());
        return response()->json(['status' => 'true', 'data' => $videos]);
    }


    public function type(Request $request)
    {
        $user = \auth()->user()->is_student;
        if ($user == 1) {
            $user_year = \auth()->user()->year_id;
            $validator = Validator::make($request->all(), [

                'subject_id' => 'required',
                "type_id" => 'required',

            ]);

            if ($validator->passes()) {
                $videos = VideoResource::collection(\App\Video::where('year_id', $user_year)->where('subject_id', $request->subject_id)->where('type_id', $request->type_id)->get());
                return response()->json(['status' => 'true', 'data' => $videos]);
            } else {
                $msg = $validator->messages()->first();
                return response()->json(['status' => "false", 'message_en' => $msg], 401);
            }
        } else {
            return response()->json(['status' => "false", 'message_en' => "ده مدرس اسطا "], 401);
        }
    }

    public function suptype(Request $request)
    {
        $user = \auth()->user()->is_student;
        if ($user == 1) {


            $user_year = \auth()->user()->year_id;

            $validator = Validator::make($request->all(), [

                'subject_id' => 'required',
                "type_id" => 'required',
                "subtype_id" => 'required',

            ]);

            if ($validator->passes()) {
                $videos = VideoResource::collection(\App\Video::where('year_id', $user_year)->where('subject_id', $request->subject_id)->where('type_id', $request->type_id)->where('subtype_id', $request->subtype_id)->get());
                return response()->json(['status' => 'true', 'data' => $videos]);
            } else {
                $msg = $validator->messages()->first();
                return response()->json(['status' => "false", 'message_en' => $msg], 401);
            }
        } else {
            return response()->json(['status' => "false", 'message_en' => "ده مدرس اسطا "], 401);
        }
    }
}
