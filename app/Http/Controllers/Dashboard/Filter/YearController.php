<?php

namespace App\Http\Controllers\Dashboard\Filter;

use App\Http\Controllers\Controller;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class YearController extends Controller
{
    public function getyear($id)
    {
        if (Auth::user() && Auth::user()->is_student == 2) {
            $subjects = auth()->user()->subjects->where('years_id', $id);
        } else {
            $subjects = Subject::where('years_id', $id)->get();
        }
        $text = "";
        $text .= ' <option value="0"  selected="selected" disabled>اختر الماده</option>';
        foreach ($subjects as $subject) {
            $text .= '<option value="' . $subject->id . '">' . $subject->name_ar . '</option>';
        }

        return response()->json($text);
    }
}//End of controller
