<?php

namespace App\Http\Controllers\Dashboard\Filter;

use App\Http\Controllers\Controller;
use App\TypesCollege;
use Illuminate\Http\Request;

class TypesCollegeController extends Controller
{
    public function getTeacher_typescollege($subjectscollege_id, $doctor_id)
    {
        $typescolleges = TypesCollege::where('subjectscollege_id', $subjectscollege_id)->where('doctor_id', $doctor_id)->get();
        $text = "";
        // $text .= '<option value="0"  disabled="disabled" >ادخل كورس</option>';
        foreach ($typescolleges as $typescollege) {
            $text .= '<option value="' . $typescollege->id . '">' . $typescollege->name_ar . '</option>';
        }
        return response()->json($text);
    }
}//End of controller
