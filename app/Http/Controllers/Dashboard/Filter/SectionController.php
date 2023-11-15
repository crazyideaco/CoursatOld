<?php

namespace App\Http\Controllers\Dashboard\Filter;

use App\Http\Controllers\Controller;
use App\Section;
use App\SubjectsCollege;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{

    public function getsection($id)
    {
        $sections = Section::where('division_id', $id)->get();

        $text = "";

        $text .= '<option value="0"   disabled="disabled">ادخل الفرقه</option>';
        foreach ($sections as $section) {
            $text .= '<option value="' . $section->id . '">' . $section->name_ar . '</option>';
        }
        return response()->json($text);
    }

    public function getsection_subjectsCollege($id)
    {
        if (Auth::user() && Auth::user()->is_student == 2) {
            $subjects = auth()->user()->subcolleges->where('section_id', $id);
        } else {
            $subjects = SubjectsCollege::where('section_id', $id)->get();
        }
        $text = "";
        $text .= ' <option value="0"   disabled="disabled">اختر الماده</option>';
        foreach ($subjects as $subject) {
            $text .= '<option value="' . $subject->id . '">' . $subject->name_ar . '</option>';
        }

        return response()->json($text);
    }
}//End of controller
