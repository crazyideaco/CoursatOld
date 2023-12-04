<?php

namespace App\Http\Controllers\Dashboard\Filter;

use App\Http\Controllers\Controller;
use App\Year;
use Illuminate\Http\Request;

class StageController extends Controller
{
    public function getstage($id)
    {
        dd('0');
        $years = Year::where('stage_id', $id)->get();
        $text = "";
        // $text .= '<option value="0"   disabled="disabled">ادخل السنه</option>';
        foreach ($years as $year) {
            $text .= '<option value="' . $year->id . '">' . $year->year_ar . '</option>';
        }
        return response()->json($text);
    }

}//End of controller
