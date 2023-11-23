<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SecuritySetting;
use App\Type;
use App\TypesCollege;
use Illuminate\Http\Request;

class TypeCollegeSecuritySettingController extends Controller
{
    protected $view = 'dashboard.college_security.';
    protected $route = 'college_security.';


    public function index($id)
    {
        $security_setting = SecuritySetting::whereTypeableId($id)->whereTypeableType(TypesCollege::class)->firstOrNew();
        return view($this->view . 'index', compact('security_setting', 'id'));
    }


    public function update(Request $request, $id)
    {
        $security_setting = SecuritySetting::whereTypeableId($id)->whereTypeableType(TypesCollege::class)->firstOrCreate();


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


        $data['typeable_id'] = $id;
        $data['typeable_type'] = TypesCollege::class;

        $security_setting->update($data);


        return redirect()->back()
            ->with(['success' => 'تم التعديل']);
    }
}
