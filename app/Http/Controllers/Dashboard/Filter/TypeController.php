<?php

namespace App\Http\Controllers\Dashboard\Filter;

use App\Http\Controllers\Controller;
use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function gettype($id, $value)
    {

        $types = Type::where('subjects_id', $value)->where('user_id', $id)->get();
        $text1 = "";
        // $text1 .= '<option value="0"  selected="selected" disabled>اختر دوره تعلميه  </option>';
        foreach ($types as $type) {
            $text1 .= '<option value="' . $type->id . '">' . $type->name_ar . '</option>';
        }

        return response()->json([$text1]);
    }
    public function getsubject_types($subjectId)
    {

        $types = Type::where('subjects_id', $subjectId)->get();
        $text1 = "";
        // $text1 .= '<option value="0"  disabled="disabled">اختر دوره تعلميه  </option>';
        foreach ($types as $type) {
            $text1 .= '<option value="' . $type->id . '">' . $type->name_ar . '</option>';
        }

        return response()->json([$text1]);
    }
}//End of contorller
