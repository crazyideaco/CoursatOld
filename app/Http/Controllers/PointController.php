<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Point;
use App\User;
use App\Notification;

class PointController extends Controller
{
    public function points()
    {
        return view('dashboard.points')->with("point", Point::orderBy('created_at', 'desc')->get());
    }
    public function addpoints($id)
    {
        return view('dashboard.addpoints')->with("point", Point::where('id', $id)->first());
    }
    public function storepoints($id, Request $request)
    {
        $po = Point::where('id', $id)->first();
        $po->point = 1;
        $po->value = $request->value;
        $po->save();
        return redirect()->route('points');
    }
    public function pointscash()
    {
        $students = User::where('is_student', 1)->whereNotNull("name")->whereNotNull("code")->get();
        return view('dashboard.pointscash')->with('students', $students);
    }
    public function getstucode($id)
    {
        $student = User::where('id', $id)->first();
        return response()->json($student);
    }
    public function getmoney($points)
    {
        $p = Point::first();
        $money = ($points * $p->value) / $p->point;
        return response()->json($money);
    }
    public function getpoints($money)
    {
        $p = Point::first();
        $point = ($money * $p->point) / $p->value;
        return response()->json($point);
    }
    public function storestupoints(Request $request)
    {
        $request->validate(
            [
                'phone' => 'required',
                'points' => 'required|numeric',
                'money' => 'required|numeric'
            ],
            [
                'required' => 'هذا الحقل مطلوب',
                'numeric' => 'هذا الحقل يقبل رقما فقط'
            ]
        );
        $stu = User::where('phone', $request->phone)->first();
        $point = $stu->points;
        $stu->points = intval($point) + intval($request->points);
        $stu->save();
        $not = new Notification;
        $not->title = 'صرف نقاط';
        $not->text = 'تم صرف' . ' ' . $request->points . ' ' . 'نقاط لك بنجاح ';
        $not->user_id = $stu->id;
        $not->save();
        $to = $stu->device_token;
        $data = [
            "to" => $to,
            'notification' => [
                'title' => $not->title,
                'body' => $not->text
            ],
            "data" => [
                'title' => $not->title,
                'body' => $not->text,
                "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                'type' => 'general'
            ],
        ];
        $dataString = json_encode($data);
        $headers = [
            'Authorization: key=AAAANEwk9ss:APA91bEuBLaq1kPuYH94OKvkO4EU_-VMrtmnj63KDB-yioNibhvl7bKbJBEQy6IvnuLyMT6AhoBi83vYe5Ds4-UaEzIyZrL9WO7ObUfTk8dIXFMih3upFFjLvPECl2ApuHe_LL2TKu6g',
            'Content-Type: application/json',
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $result = curl_exec($ch);
        return redirect()->route('states');
    }
}
