<?php

namespace App\Http\Controllers\Dashboard\Filter;

use App\Division;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function getdivision($id)
    {
        $divisions = Division::where('college_id', $id)->get();
        $text = "";
        // $text .= '<option value="0" selected="selected"  disabled="disabled">ادخل القسم</option>';
        foreach ($divisions as $division) {
            $text .= '<option value="' . $division->id . '">' . $division->name_ar . '</option>';
        }
        return response()->json($text);
    }
}
