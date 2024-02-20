<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SecuritySetting;
use App\Type;
use Illuminate\Http\Request;

class SecuritySettingController extends Controller
{
    protected $view = 'dashboard.security.';
    protected $route = 'security.';


    public function index($id)
    {
        $security_setting = SecuritySetting::whereTypeableId($id)->whereTypeableType(Type::class)->firstOrNew();
        return view($this->view . 'index', compact('security_setting', 'id'));
    }


    public function update(Request $request, $id)
    {
        $security_setting = SecuritySetting::whereTypeableId($id)->whereTypeableType(Type::class)->firstOrCreate();


        $data['show_video_code'] = $request->show_video_code;
        if ($request->show_video_code == 0) {
            $data['video_code_type'] = null;
        } else {
            $data['video_code_type'] = $request->video_code_type;
        }
        if ($request->video_code_type == 2) {
            $data['code_duration'] = $request->code_duration;
        } else {
            $data['code_duration'] = null;
        }

        $data['simulator'] = $request->simulator;
        $data['phone_color'] = $request->phone_color;


        $data['typeable_id'] = $id;
        $data['typeable_type'] = Type::class;

        $security_setting->update($data);


        return redirect()->back()
            ->with(['success' => 'تم التعديل']);
    }
}
